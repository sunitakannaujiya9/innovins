<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    public function signIn()
    {
        return view('auth.login');
    }

    
public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ],[
        'email.required' => 'Email is required',
        'password.required' => 'Password is required',
        ]);

    $credentials = $request->only('email', 'password');
    $remember_me = $request->has('remember_token') ? true : false;
    
    if (Auth::attempt($credentials, $remember_me)) {
        return redirect('dashboard')->with('message', 'You are logedin Sucessfully.');
    }
    else{
        return redirect()->back()->with('error', 'You have entered invalid credentials');
    }

}


public function logout() {
    Session::flush();
    Auth::logout();

    return redirect('/');
}
}
