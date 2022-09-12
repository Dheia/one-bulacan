<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $business;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business)
    {
         $this->business = $business;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->view('mail.mail_to_user')
                    ->subject(env('APP_NAME') . ' Registration')
                    ->with(
                    [
                        'data' => $this->business
                    ]);
    }
}
