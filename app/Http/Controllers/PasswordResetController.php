<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Str;
use DB;

class PasswordResetController extends Controller
{
    // forgot password endpoint
    public function forgot(Request $request) {

        $request->validate([
            'email' => 'required|email',
        ]);

       $email = $request->input('email');

       if (User::where('email', $email)->doesntExist()){
           return response([
               'message' => 'User doesn\'t exist!'
           ], 404);
       }

        $token = rand(10000, 99999);// 10000 + Math.random() * 90000

       try{
            DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);


        $data=$token;
        Mail::to($email)->send(new PasswordReset($data));

        return response([
            'message' => 'Check your email!'

        ]);

    } catch(Exception $exception) {
        return response([
            'message' => $exception->getMessage()
        ], 400);
     }

    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */

     // verify token or for password

    public function verifyToken(Request $request){
        $request->validate([
            'token' => 'required',        
        ]);

        $token = $request->input('token');


        if(!$passwordResets =  DB::table('password_resets')->where('token', $token)->first()){
            return response ([
                'message' => 'Invalid token!'
            ], 400);

        }

       // $user->save();

        return response([
            'message' => 'successful verify your token'
        ]);
    }

      // resetPassword

    public function resetPassword(Request $request){
        $request->validate([
        
            'password' => 'required|same:password',
        
        ]);

        $email = $request->input('email');


        if(!$passwordResets =  DB::table('password_resets')->where('email', $email)->first()){
            return response ([
                'message' => 'Invalid email!'
            ], 400);

        }

        if(!$user = User::where('email', $passwordResets->email)->first()) {
            return response([
                'message' => 'Your email doesn\'t exist!'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'successful changed your password'
        ]);
    }
}
