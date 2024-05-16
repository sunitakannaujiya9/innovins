<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function signUp()
    {
        return view('auth.register');
    }

    
    public function store(Request $request){

        $this->validate($request, [
            'name'=>'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required',
            'cnf_pass'=>'required|same:password',
        ],
        [
           'cnf_pass.required' =>'Confirm password is required',
           'cnf_pass.same' => 'Confirm password must match password',
        ]);
    
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/')->with("message", "Registered Successfull");
    }
    
}
