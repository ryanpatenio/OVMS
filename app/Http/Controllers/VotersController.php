<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class VotersController extends Controller
{
    //

    // public function index(){
    //     return view(
    //         'voters.index'
    //     );
    // }

    public function VotersLoginForm(){
        return view('voters.voters-login-form');
    }
    public function VoteNowPage(){
        if(Gate::denies('can-vote')){
            abort(403);
        }
        return view('voters.vote-now');
    }


}
