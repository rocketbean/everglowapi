<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json("user failed to register", 304);
        }
        
        return $this->create($request->all());
        // return $this->validator($request->all());
    }

    public function generateToken ($email) {
        $user = User::where('email', $email)->first();
        $token = $user->createToken('tokentest');
        return $token;
    }

    public function authenticate (Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $this->generateToken($request->email);
            return [
                'user' => $user,
                'token' => $token
            ];
        }
        return response()->json("we cannot find your credentials to our records",401);
    }
}
