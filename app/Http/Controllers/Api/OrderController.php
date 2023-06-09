<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $orders = Order::whereUserId($user->id)
            ->latest()
            ->with(['from','to'])
            ->paginate($request->input('per_page'));
        return OrderResource::collection($orders);
    }

    public function store(OrderStoreRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        Order::create($data);
        return new MessageResource(['message' => 'Успешно сохранено']);
    }
}
