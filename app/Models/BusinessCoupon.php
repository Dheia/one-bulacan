<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class BusinessCoupon extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'business_coupons';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['code', 'secret', 'business_id', 'title', 'description', 'quantity', 'start_at', 'end_at'];
    // protected $hidden = [];
    protected $dates = ['start_at', 'end_at'];
    protected $appends = ['qr_code'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
    public function getQrCodeAttribute() 
    {
        $path = url('coupon/' . $this->business_id . '/' . $this->secret);
        if($this->secret) {
            $qrCode = \QrCode::size(150)->generate($path);
            return $qrCode;
        } else {
            return null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
