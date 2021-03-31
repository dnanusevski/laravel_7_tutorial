<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	/*
	// to validate login, stop or do whatver before login attempt
	protected function validateLogin(Request $request)
    {
        $request->validate([
           $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
		exit('NO MORE LOGIN BITH but from login controller');
    }
	
	// to remove or add remeber
	protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
	// to do something after successfull login like redirect diferent user, like admin to admin panel, office to office panel etc
	protected function authenticated(Request $request, $user)
    {
        exit('You are authenticated now we wil lsee who you are and redirect you where you shoud go ok');
    }
	*/
}
