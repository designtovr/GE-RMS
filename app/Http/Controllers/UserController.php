<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $users = User::all();
        return response()->json(['data' => $users, 'status' => 'success']);
    }
}
