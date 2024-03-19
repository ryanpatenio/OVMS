<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\TMAIL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\TCODE;
use App\Http\Controllers\tokenController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    //this function is for redirected the user after he/she registered into login page
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $emaill = "tyrone.malocon@ecddigital.com.au";
        $token = new tokenController();
        $userEmail = $request->input('email');
        $code = new TCODE();
        $userCode = $code->getCode();
        $token->addToken($userEmail,$userCode);
        Mail::to($emaill)->send(new TMAIL("Account verification", "Please verify account","",$userCode,$userEmail));

        return redirect($this->redirectPath())->with('message', 'Your message');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'string', 'min:11','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],


        ]
    );

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact'=> $data['contact'],
            'password' => Hash::make($data['password']),

        ]);

    }
}
