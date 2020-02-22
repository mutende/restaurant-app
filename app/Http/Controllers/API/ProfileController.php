<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');


    }

    public function userProfile(){

        return auth('api')->user();
    }

    public function updateProfile(Request $request){

        $user =  auth('api')->user();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' =>'sometimes|required|min:6'
        ]);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        if($user->update($request->all())){
            return ["Message" => "Success"];
        }
         return ["Error" => "Update Failed"];
    }
}
