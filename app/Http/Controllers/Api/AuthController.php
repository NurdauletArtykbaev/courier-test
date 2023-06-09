<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data  = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json(['data' => $user->createToken("API TOKEN")->plainTextToken]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if (!Hash::check($request->password, $user->password))  {
            return  new \ErrorException('неправильный пароль',400);
        }
        return response()->json(['data' => $user->createToken("API TOKEN")->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }
}
