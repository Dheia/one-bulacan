<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\MessageBag;

class BusinessLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:business-portal')->except('logout');
    }

    public function showLoginForm()
    {
      // return view('auth.login');
      $title = "Login";
       return view('auth.business_login')->with('title', $title);
    }

    public function login(Request $request)
    {
      $errors = new MessageBag;

      $this->validate($request, [
        'email' => 'required|email',
        'password'      => 'required'
      ]);

      // Attempt to log the user in
      if (Auth::guard('business-portal')->attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $request->remember)) 
      {
        // if successful, then redirect to their intended location
        return redirect()->to(url()->current());
      }
      $errors->add('email', 'These credentials do not match our records.');
            

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withErrors($errors)->withInput($request->only('email'));
    }

    public function redirect ()
    {
      return redirect('one-portal/login');
    }

    
    public function logout(Request $request) 
    {
      Auth::guard('business-portal')->logout();
      return redirect('one-portal/login');
    }

    protected function guard()
    {
      return Auth::guard('business-portal');
    }
}
