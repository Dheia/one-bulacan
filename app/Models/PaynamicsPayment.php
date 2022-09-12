<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaynamicsPayment extends Model
{
    use CrudTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'paynamics_payments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'payment_method_id',
        'paymentable_id',
        'paymentable_type',
        
        'firstname',
        'lastname',
        'email',
        'mobile',
        'address',
        'description',

        'amount',
        'fee',

        'pay_reference',
        'raw_data',
        'initial_response',

        'request_id',
        'response_id',
        'merchant_id',
        'expiry_limit',
        'direct_otc_info',
        'payment_action_info',
        'response',

        'timestamp',
        'rebill_id',
        'signature',
        'response_code',
        'response_message',
        'response_advise',
        'settlement_info_details',

        'mail_sent',
        'status'
    ];
    // protected $hidden = [];
    protected $dates = ['datetime', 'created_at'];
    protected $appends = ['payment_method_name', 'payment_method_logo', 'payment_from', 'payment_to', 'total_amount'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function paymentable()
    {
        return $this->morphTo();
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getPaymentMethodNameAttribute()
    {
        $paymentMethod = $this->paymentMethod()->first();
        return $paymentMethod ? $paymentMethod->name : null;
    }

    public function getPaymentMethodLogoAttribute()
    {
        $paymentMethod = $this->paymentMethod()->first();
        return $paymentMethod ? $paymentMethod->logo : null;
    }

    public function getPaymentToAttribute()
    {
        $paymentable = $this->paymentable()->first();
        return $paymentable ? $paymentable->name : null;
    }

    public function getPaymentFromAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getTotalAmountAttribute()
    {
        return (double)$this->amount + (double)$this->fee;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
