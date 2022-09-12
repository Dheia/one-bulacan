<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Newsletter;

class NewsLetterController extends Controller
{
    
    public function registerAccount(Request $request)
    {
        $messages = [
            'unique'    =>  'The :attribute is already registered.',
        ];
        $validator = Validator::make($request->all(), [
            'email'     =>  'required|email|unique:newsletters,email',
        ], $messages);
        if ($validator->fails()) {
            return redirect(url()->previous() .'#newsletterform')
                        ->withErrors($validator)
                        ->withInput();
        }
        $newsletter = new Newsletter();
        $newsletter->email  = request('email');
        $newsletter->active = 1;
        $newsletter->save();
        return redirect(url()->previous() .'#newsletterform')->with('success', 'Successfully Registered!'); 
    }
}
