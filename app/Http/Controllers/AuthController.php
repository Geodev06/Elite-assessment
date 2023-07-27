<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $remember = $request->input('remember');

        if (Auth::attempt($credentials, $remember)) {

            return response()->json(['message' => 'login success'], 200);
        }
        return response()->json(['message' => 'You have entered incorrect credentials please check your username and password!'], 401);
    }

    public function register()
    {
        return view('auth.register');
    }

    function store(UserRequest $request)
    {
        if ($request->ajax()) {

            $data = [
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ];

            User::create($data);

            return response()->json(['message' => 'user has been successfully created!'], 200);
        }
    }

    public function destroy()
    {
        User::where('id', Auth::user()->id)->delete();
        Auth::logout();
        return redirect()->intended('/');
    }
}
