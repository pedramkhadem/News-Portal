<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Validator;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'your password or email was incorrect ! '
            ]);
        }

        return response()->json([
            'message'=>'Login Succssfuly',
            'customer' => $user,
            'token' => $user->createToken('mobile', ['role:user'])->plainTextToken
        ]);


    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'User Successfully logged out',
        ]);
    }


    public function register(Request $request)
    {
        $validate = Validator::make($request->all() , [
            'name' => ['required' , 'string'  , 'max:255'],
            'email'=>['required' , 'email'],
            'password'=> ['required' , 'min:6']
        ]);

        //if validate fails

        if($validate->fails()){
            return response()->json([
                'message'=>$validate->errors()->first(),
            ], 400);
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'User created successfully'
        ], 201);

    }


    public function update(Request $request , User  $user)
    {
        $validate = Validator::make($request->all() , [
            'name' => ['required' , 'string'  , 'max:255'],
            'email'=>['required' , 'email'],
            'password'=> ['required' , 'min:6']
        ]);

        if($validate->fails()){
            return response()->json([
                'message'=>$validate->errors()->first(),
            ], 400);
        }

        $user->update($request->all());
        return response()->json([
            'message'=>'your profile updated',
            'user'=>$user,

        ]);


    }

}







