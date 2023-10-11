<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        //role
        //admin == 1
        //user -- ballot creator == 2
        //voters = 3
        //candidates = 4
        //user == 0 (default)

    // if(Auth::check()){

    //     if(Auth::user()->role == '1'){
    //         //admin side
    //         return redirect('/admin');
    //     }elseif(Auth::user()->role == '2'){
    //         //user ballot creator
    //         return  $next($request);
    //     }elseif(Auth::user()->role == '0'){
    //         return redirect('/');
    //     }
    // }else{
    //     //not authenticated
    //     return redirect('/login')->with('message','log in first!');
    // }
        //this is middleware
        if($role == 'admin' && auth()->user()->role != 1){
            abort(403);
        }
        if($role == 'ballotCreator' && auth()->user()->role != 2){
            abort(403);
        }
        if($role == 'voters' && auth()->user()->role != 3){
            abort(403);
        }
        if($role == 'candidates' && auth()->user()->role != 4){
            abort(403);
        }


        return $next($request);
    }

}
