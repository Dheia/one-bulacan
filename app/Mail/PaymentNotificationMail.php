<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class PaymentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paynamicsPayment;
    public $business;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paynamicsPayment)
    {
        $this->paynamicsPayment = $paynamicsPayment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paynamicsPayment       = $this->paynamicsPayment;
        $this->business         = $paynamicsPayment->paymentable;

        $this->data = [
            'business'          => $this->business,
            'paymentMethod'     => $paynamicsPayment->paymentMethod,
            'paynamicsPayment'  => $paynamicsPayment,
            'amount'            => (double)$paynamicsPayment->amount + (double)$paynamicsPayment->fee
        ];

        return $this->from($this->business->email)
                    ->view('mail.payment_notification')
                    ->subject('Payment Confirmation for ' . $this->business->name)
                    ->with($this->data);
    }
}
