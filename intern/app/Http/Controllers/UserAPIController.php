<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;

class UserAPIController extends Controller
{
    //
    public function registration(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:20'
        ]);

        $user = new UserInfo();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = md5 ($req->password);
        $user->save();
    }

    public function login(Request $req)
    {
        $user = UserInfo::where('email',$req->email)->where('password',md5($req->password))->first();
        if($user){
            return "login success";
        }
        else{
            return "Failed";
        }
    }
}
