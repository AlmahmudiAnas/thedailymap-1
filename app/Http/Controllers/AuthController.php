<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 'active',
            ])
        ) {
            $user = $request->user();
            $success['token'] = $user->createToken(
                $user->email . '' . $user->id
            )->plainTextToken;
            $success['name'] = $user->name;
            $success['message'] = 'User login successfully.';
            $success['data'] = User::where('email', $request->email)
                ->with([
                    'permissions:id,name',
                    'roles:id,name',
                    'roles.permissions:id,name',
                ])
                ->first();
            // activity()
            // 	->event('login')
            // 	->causedBy($user)
            // 	->log('the user was logged...');
            return response($success, 200);
        }

        return response(['error' => 'Unauthorised'], 421);
    }
    public function logout(Request $request)
    {
        // activity()
        // 	->event('logout')
        // 	->causedBy($request->user())
        // 	->log('the user was logout from the system...');
        return response(
            [
                'message' => 'logout success',
                'data' => $request
                    ->user()
                    ->currentAccessToken()
                    ->delete(),
            ],
            200
        );
    }

    public function register(RegisterRequest $request)
    {
        // All() to get all data from request ....


        $data = User::create([
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'api_token' => Str::random(60),
            'firebase_token' => $request->message_token,

            "username" => $request->username,
            "device_name" => $request->device_name,
            "full_name" => $request->full_name,
            "birthday" => $request->birthday,
            "country" => $request->country,
        ]);
        if ($data->save())
            return response()->json([
                'message' => 'success',
                'status_code' => 200,
                'data' => $data->save(),
            ]);
        return response()->json(['message' => 'fail']);
    }
}
