<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthUserController extends Controller
{
     /**
     * create registration end point
     */ 

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        try{
            // create new user and save
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                
            ]);
                
            return response()->json([
                'message' => 'Registration Successful',
                // 'token' => $user->createToken($request->name)->plainTextToken
                'token' => $user->createToken($user->name)->accessToken,
                'User' => $user
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage() . ' on line '  . $e->getLine(), 500);
        }
    }

    /**
     * Login end point
     */ 

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = strtolower($request->email);
        $user = User::where('email', $email)->first();
        if(empty($user))
        {
            $user = User::where('id', $email)->first();
            if (empty($user)) 
            {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            } else {
                $user = User::where('email', $user->email)->first();
            }
        }
        $user = User::where('id', $user->id)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

            return [
                'message' => 'Login Successful',   
                'data' => [
                'token' => $user->createToken($user->name)->accessToken,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $user->email_verified_at,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ],
                ]
            ];               
    }

    /**
     * logout end point
     */ 

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        $token = $request->user()->token();
        $token->revoke();
        return [
            'message' => 'Successful Logout',
        ];
    }

}
