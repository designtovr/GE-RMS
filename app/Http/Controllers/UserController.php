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
use App\Http\Repositories\MailRepository;

class UserController extends Controller
{
    protected $mailRepository;

    function __construct(MailRepository $mailRepository)
    {
        $this->mailRepository = $mailRepository;
    }
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
    	$credentials = $request->only('username', 'password');
    	if (Auth::attempt($credentials)) {
    		$user = User::where('username', $credentials['username'])->first();
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

    public function ForgotPassword(Request $request)
    {
        $data = $request->all();
        if (!array_key_exists('username', $data) || is_null($data['username']))
            return response()->json(['status' => 'failure', 'message' => 'Username Required'], 200);
        $US = User::where('username', $data['username'])->first();
        if(!$US)
            return response()->json(['status' => 'failure', 'message' => 'Invalid Username'], 200);
        $email = $US->email;
        $username = $US->username;
        $password = mt_rand(111111, 999999);
        $message = 'New Password sent to your mail.';
        if(is_null($email) || empty($email))
        {
            $admin = User::find(1);
            $email = $admin->email;
            $message = 'Please, Contact your Admin for New Password.';
        }
        $mail_result = $this->mailRepository->ForgotPasswordMail($email, $username, $password);
        if(strcasecmp('success', $mail_result) == 0)
        {
            $US->password = Hash::make($password);
            $US->updated_at = Carbon::now();
            $US->updated_by = Auth::id();
            $US->update();

            return response()->json(['status' => 'success', 'message' => $message], 200);
        }
        else
        {
            return response()->json(['status' => 'failure', 'message' => 'Mail Service is not working.Please, Contact Admin.'], 200);
        }

    }

    public function ChangePassword(Request $request)
    {
        $changepassword = $request->get('changepassword');
        if(strcasecmp($changepassword['new_password'], $changepassword['confirm_password']) != 0)
        {
            return response()->json(['status' => 'failure', 'message' => 'New Password are not similar'], 200);
        }
        $US = User::find(Auth::id());
        $US->password = Hash::make($changepassword['new_password']);
        $US->update();
        return response()->json(['status' => 'success', 'message' => 'Password Changed Successfully'], 200);
    }

    public function Users(Request $request)
    {
        $users = User::selectRaw('users.id, users.name, users.username, users.email, users.password, ro.name as role, ro.id as role_id')->leftJoin('role_user as ru', 'users.id', 'ru.user_id')->leftJoin('roles as ro', 'ro.id', 'ru.role_id')->orderBy('users.id')->get();

        return response()->json(['data' => $users, 'status' => 'success']);
    }

    public function AddUser(AddUserRequest $request)
    {
        $user = $request->get('user');
        if (preg_match('/\s/',$user['username'])) {
            return response()->json(['status' => 'failure', 'message' => 'Space Not Allowed in Username'], 200);
        }
        if(ctype_space($user['username']))
        {
            return response()->json(['status' => 'failure', 'message' => 'Space Not Allowed in Username'], 200);
        }
        if (array_key_exists('id', $user))
        {
            if(User::where('username', $user['username'])->where('id', '<>',$user['id'])->first())
            {
                return response()->json(['status' => 'failure', 'message' => 'Username already exists'], 200);
            }
            $US = User::find($user['id']);
            $US->name = $user['name'];
            $US->username = trim($user['username']);
            if(array_key_exists('email', $user))
            {
                $US->email = $user['email'];
            }
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
            if(User::where('username', $user['username'])->first())
            {
                return response()->json(['status' => 'failure', 'message' => 'Username already exists'], 200);
            }
            $US = new User();
            $US->name = $user['name'];
            $US->username = trim($user['username']);
            $US->email = (array_key_exists('email', $user))?$user['email']:'';
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
