<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Requests\RegistrationFormRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        Config::set('jwt.user', 'App\Models\User'); 
        Config::set('auth.providers.users.model', \App\Models\User::class);
        $credentials = $request->only('email', 'password');
        $token = null;
        try {

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }
                
        } catch (JWTAuthException  $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
       
        return response()->json([
            'success' => true,
            'user'=>  JWTAuth::user(),
            'token' => $token,
        ]);
    }

   
}
