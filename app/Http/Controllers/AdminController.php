<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    //

    public function index(){
        if(Gate::denies('manage-all')){
            abort(403);
        }

        return view('admin.dashboard-admin');
    }
}
