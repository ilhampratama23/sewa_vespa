<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token =  $user->createToken('MyApp')->accessToken;
        $name =  $user->name;
   
        return response()->json([
            'token' => $token,
            'nama' => $name,
        ]);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')->accessToken;
            $name =  $user->name;
   
            return response()->json([
                'token' => $token,
                'nama' => $name,
            ]);
        } 
        else{ 
            return response()->json([
                'error' => 'Unathorized',
            ], 422);
        } 
    }

    public function userProfile()
    {
        $user = Auth::user();
        $user = $user->makeHidden(['email_verified_at', 'password', 'remember_token']);

        return response()->json([
            'data' => $user
        ], 200);
    }
}
