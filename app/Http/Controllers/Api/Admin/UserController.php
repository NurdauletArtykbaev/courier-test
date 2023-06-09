<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::latest()->with('role')->paginate($request->input('per_page'));
        return UserResource::collection($users);
    }

    public function show($id,Request $request)
    {
        $users = User::with('role')->findOrFail($id);
        return new UserResource($users);
    }
    public function changeRoleAdmin($id,Request $request)
    {
        $role = Role::whereName(RoleHelper::ADMIN)->firstOrFail();

        $user = User::findOrFail($id);
        $user->role_id = $role->id;
        $user->save();
        return new UserResource($user);
    }
}
