<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\MessageBag;

class UserLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:web')->except('logout');
    }

    public function showLoginForm()
    {
      dd(Auth::guard());
      // return view('auth.login');
      $title = "Login";
       return view('auth.login')->with('title', $title);
    }

    public function login(Request $request)
    {
      $errors = new MessageBag;

      $this->validate($request, [
        'business_number' => 'required',
        'password'      => 'required'
      ]);

      // Attempt to log the user in
      if (Auth::guard('business')->attempt(['business_number' => $request->business_number, 'password' => $request->password], $request->remember_token)) 
      { 
        // if successful, then redirect to their intended location
        return redirect()->to(url()->current());
      }
      $errors->add('business_number', 'These credentials do not match our records.');
            

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withErrors($errors)->withInput($request->only('business_number'));
    }

    public function redirect ()
    {
      return redirect('admin-one/login');
    }

    //
    public function logout(Request $request) 
    {
      Auth::guard('web')->logout();
      return redirect('admin-one/login');
    }
}
