<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return Cache::remember('cities',3600, function () {
            return CityResource::collection(City::isActive()->orderBy('name')->get());
        });
    }
}
