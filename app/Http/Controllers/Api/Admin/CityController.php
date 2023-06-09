<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CitySaveRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return CityResource::collection(City::orderBy('name')->get());
    }

    public function show($id, Request $request)
    {
        return new CityResource(City::findOrFail($id));
    }

    public function store(CitySaveRequest $request)
    {
        City::create($request->validated());
        return response()->noContent();
    }

    public function update($id, CitySaveRequest $request)
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());
        return response()->noContent();
    }

    public function destroy($id, Request $request)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->noContent();
    }
}
