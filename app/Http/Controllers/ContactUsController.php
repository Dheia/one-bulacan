<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

// Models
use App\Models\Message;

// Mail
use Mail;
use App\Mail\ContactUsMail;

class ContactUsController extends Controller
{
    public $data;
    public $date;

    function __construct()
    {
        $this->date = Carbon::now()->format('Y-m-d');
    }

    public function contactUs(){
        $location         =   Config('settings.province') ?? "Project One";
        $title            =   "Contact Us | One " . $location;
        return view('v2.pages.contact')->with('title', $title);
    } 
    
    public function sendMessage(Request $request)
    {
        try {
            // Validate Message
            $validator  =   Validator::make($request->all(), [
                                'email'                 =>  'required|email',
                                'name'                  =>  'required|min:5|max:50',
                                'subject'               =>  'required|min:5|max:50',
                                'body'                  =>  'required|min:5|max:255',
                                'g-recaptcha-response'  =>  'required|captcha',
                            ]);
            
            // Error Inputs
            if ($validator->fails()) {
                return redirect(url()->previous() .'#contactform')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Store The Message
            $message = Message::create([
                'sender_name'   => $request->name,
                'sender_email'  => $request->email,
                'subject'       => $request->subject,
                'content'       => $request->body,
                'status'        => 0
            ]);

            // Mail The Message
            $emails = [config('settings.contact_email'), 'jmanalo@tigernethost.com'];
            Mail::to($emails)->send(new ContactUsMail($message));

            $data = [
                'success' => true,
                'sender'  => $request->name,
                'message' => 'Message Succesfully Sent!'
            ];

        }  catch (\Exception $e) {
            $data = [
                'success' => false,
                'sender'  => $request->name,
                'message' => "There's been an error. Your message may not have been sent. Please contact us here 
                                <a href='mailto:" . config('settings.contact_email') . "'>" . config('settings.contact_email') . " </a> for support."
            ];

            \Log::info([
                'TITLE'   => 'Contact Us Error', 
                'SENDER'  => $request->name,
                'DATE'    => Carbon::now()->format('F j, Y - h:i A'),
                'ERROR'   => $e
            ]);
        }

        return redirect(url()->previous() .'#Success')->with($data);
    }

}
