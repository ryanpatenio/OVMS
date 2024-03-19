<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class TCODE extends Controller
{
    public function getCode(){
        $letters = Str::random(21); 
        $numbers = mt_rand(10000, 99999); 

        $randomCode = $letters . $numbers;
        return $randomCode;
    }
}
