<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\OrderStatusHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderConcatRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest()
            ->when($request->from_city_id, fn($query) => $query->where('from_city_id', $request->from_city_id))
            ->when($request->to_city_id, fn($query) => $query->where('to_city_id', $request->to_city_id))
            ->when($request->delivery_date, fn($query) => $query->whereDate('delivery_date', $request->delivery_date))
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->with(['from', 'to', 'user'])
            ->withCount('concatOrders')
            ->whereNull('parent_id')
            ->paginate($request->input('per_page', 20));
        return OrderResource::collection($orders);
    }

    public function cancel($id, Request $request)
    {

        $order = Order::findOrFail($id);
        $order->status = OrderStatusHelper::CANCELLED;
        $order->comment = $request->comment;
        $order->save();
        return response()->noContent();
    }

    public function concat(OrderConcatRequest $request)
    {
        $ids = $request->input('ids', []);
        $orders = Order::whereIn('id', $ids)->get();
        $this->checkByUniqueDateAndCities($orders);
        $this->concatOrders($orders);
        return response()->noContent();
    }

    private function concatOrders($orders)
    {
        $parentOrder = $orders->first();
        $orders = $orders->whereNot('id', $parentOrder->id);
        foreach ($orders as $order) {
            $order->parent_id = $parentOrder->id;
            $order->save();
        }
    }

    private function checkByUniqueDateAndCities($orders)
    {
        $fromCityIds = $orders->pluck('from_city_id', 'id')->unique()->toArray();
        $toCityIds = $orders->pluck('to_city_id', 'id')->unique()->toArray();
        $date = $orders->pluck('date', 'id')->map(fn($item) => Carbon::create($item)->format('d.m.Y'))->unique()->toArray();

        if (count($fromCityIds) > 1) {
            throw  ValidationException::withMessages(['from_city_id' => ['Не совпадает город A']]);
        }
        if (count($toCityIds) > 1) {
            throw  ValidationException::withMessages(['to_city_id' => ['Не совпадает город B']]);
        }
        if (count($date) > 1) {
            throw  ValidationException::withMessages(['date' => ['Дата']]);
        }
    }
}
