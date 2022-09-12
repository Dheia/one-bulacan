<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class PaymentInstructionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $business           = $this->data['business'];
        $paymentMethod      = $this->data['paymentMethod'];
        $paynamicsPayment   = $this->data['paynamicsPayment'];

        return $this->from($business->email)
                    ->view('mail.payment_instructions')
                    ->subject('Payment Instruction for ' . $business->name)
                    ->with($this->data);
    }
}
