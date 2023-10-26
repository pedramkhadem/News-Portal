<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message'=>'your password or email was incorrect ! '
            ]);
        }

        return response()->json([
            'message'=> 'Succssfuly Login',
            'admin' => $admin,
            'token' => $admin->createToken('login', ['role:admin'])->plainTextToken
        ]);

    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Admin Successfully logged out',
        ]);
    }
    public function update(Request $request , Admin  $admin)
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
        $admin->update($request->all());
        return response()->json([
            'message'=>'your profile updated',
            'user'=>$admin,

        ]);


    }
}
