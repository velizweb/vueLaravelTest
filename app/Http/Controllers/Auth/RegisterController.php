<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\User
     */
    protected function create(Request $data)
    {
        if (!$data['name'] || !$data['email'] || !$data['password']) {
            return response()->json(['message' => 'Fields required'], 411);
        }

        if (!User::where('email', $data['email'])->count()) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return response()->json(['message' => 'User registered successfully'], 201);
        } else {
            return response()->json(['message' => 'User exist'], 401);
        }
    }
}
