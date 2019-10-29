<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddUserRequest;
use Hash;
use Carbon\Carbon;

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
        $users = User::selectRaw('users.id, users.name, users.email, users.password, ro.name as role, ro.id as role_id')->leftJoin('role_user as ru', 'users.id', 'ru.user_id')->leftJoin('roles as ro', 'ro.id', 'ru.role_id')->orderBy('users.id')->get();

        return response()->json(['data' => $users, 'status' => 'success']);
    }

    public function AddUser(AddUserRequest $request)
    {
        $user = $request->get('user');
        if (array_key_exists('id', $user))
        {
            $US = User::find($user['id']);
            $US->name = $user['name'];
            $US->email = $user['email'];
            if (Hash::needsRehash($user['password'])) {
                $US->password = Hash::make($user['password']);
            }
            $US->updated_by = Auth::id();
            $US->updated_at = Carbon::now();
            $US->update();
            //modify role except for admin(id=1)
            if ($user['id'] != 1)
            {
                //deleting old role
                RoleUser::where('user_id', $US->id)->delete();

                //assigning new role
                $RU = new RoleUser();
                $RU->user_id = $US->id;
                $RU->role_id = $user['role'];
                $RU->save();
            }

            return response()->json(['data' => $US, 'status' => 'success', 'message' => 'User Updated Successfully'], 200);
        }
        else
        {
            $US = new User();
            $US->name = $user['name'];
            $US->email = $user['email'];
            $US->password = Hash::make($user['password']);
            $US->created_by = Auth::id();
            $US->created_at = Carbon::now();
            $US->save();

            $RU = new RoleUser();
            $RU->user_id = $US->id;
            $RU->role_id = $user['role'];
            $RU->save();

            return response()->json(['data' => $US, 'status' => 'success', 'message' => 'User Added Successfully'], 200);
        }
    }

    public function DeleteUser($id)
    {
        if ($id == 1)
        {
            return response()->json(['status' => 'failure', 'message' => "You Can't Delete This User"], 200);
        }
        User::destroy($id);
        RoleUser::where('user_id', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'User Deleted Successfully'], 200);
    }
}
