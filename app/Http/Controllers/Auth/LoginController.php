<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
        //this authenticated function is default in laravel
        // public function login(Request $request)
        // {
        //        $request->validate([
        //             'email' => 'required',
        //             'password' => 'required',
        //         ]);
        //       if(Auth::user()->role == '')
        //         $credentials = $request->only('mobile', 'password');
        //         if (Auth::attempt($credentials)) {
        //             URL::to('home');
        //         }

        //         return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');

        //  }

        protected function authenticated(){

            //role = 1 is admin
            // role = 2 is user or ballot creator
            //role = 3 is voters
            if(Auth::user()->role == '1'){
                //user as Admin
                return redirect('/admin/dashboard-admin');

            }elseif(Auth::user()->role == '2'){
                //user as user Ballot Admin
                return redirect('ballotAdmin/ballot-dashboard');
            }elseif(Auth::user()->role == '3'){
                //this is for voters only need edit
                return redirect('/');
            }else{

                return redirect('/');
            }

         }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
