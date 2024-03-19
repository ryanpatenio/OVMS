<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\token;
use App\Models\User;

class tokenController extends Controller
{
    public function addToken($email, $code){
        token::insert([
            "email" => $email,
            "token" =>$code
        ]);
    }

    public function verifyUser(Request $req){
        $code = $req->input("code");
        $email = $req->input("mail");
        $data = token::where("token", $code)->get();
        if($data->isEmpty()){
            echo "redirect to error page/ link is expired link";
        }
        else{
            User::where("email",$email)->update(["stat" => 1]);
            return view("emails.success");
        }
        
    }
}
