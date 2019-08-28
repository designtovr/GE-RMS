<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddUserRequest;

class UserController extends Controller
{
    //
    public function UserCheck(Request $request)
    {
    	$user = User::with('Roles')->find(1);
    	if ($user->isAdministrator())
    	{
    		return "Admin";
    	}
    	else
    	{
    		return "No Admin";
    	}
    	return $user;
    }

    public function DoLogin(Request $request)
    {
    	$credentials = $request->only('email', 'password');
    	if (Auth::attempt($credentials)) {
    		$user = User::where('email', $credentials['email'])->first();
    		Auth::login($user);
            return response()->json(["status" => "success"]);
        }
    	return response()->json(["status" => "failure"]);
    }

    public function Logout(Request $request)
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function Users(Request $request)
    {
        $users = User::selectRaw('users.id, users.name, users.email, ro.name as role')->leftJoin('role_user as ru', 'users.id', 'ru.user_id')->leftJoin('roles as ro', 'ro.id', 'ru.role_id')->orderBy('users.id')->get();
        return response()->json(['data' => $users, 'status' => 'success']);
    }

    public function AddUser(AddUserRequest $request)
    {
        $user = $request->get('user');
        $US = new User();
        $US->name = $user['name'];
        $US->email = $user['email'];
        $US->password = bcrypt($user['password']);
        $US->save();

        $RU = new RoleUser();
        $RU->user_id = $US->id;
        $RU->role_id = $user['role'];
        $RU->save();

        return response()->json(['data' => $US, 'status' => 'success', 'messagae' => 'User Added Successfully'], 200);
    }
}
