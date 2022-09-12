<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use CrudTrait;
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sales';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['business_id', 'emailed', 'messaged', 'notified', 'paid', 'payment_thru', 'reference_no', 'paid_to'];
    // protected $hidden = [];
    // protected $dates = [];

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
    public function business() {
        return $this->belongsTo('App\Models\Business', 'business_id');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getBusinessNameAttribute()
    {
        $business_name  =   Business::where('id', $this->business_id)->first();
        return  $business_name ? $business_name->name : "";
    }

    public function getContactPersonAttribute()
    {
        $contact_person =   Business::where('id', $this->business_id)->first();
        return  $contact_person ? $contact_person->contact_person : "";
    }
    public function getContactNumberAttribute()
    {
        $contact_number =   Business::where('id', $this->business_id)->first();
        return  $contact_number ? $contact_number->mobile : "";
    }

    public function getDateRegisteredAttribute()
    {
        $date_registered =  Business::where('id', $this->business_id)->first();
        return  $date_registered ? $date_registered->created_at : "";
    }

    public function getVerifiedAttribute()
    {
        $business       =   Business::where('id', $this->business_id)->first();
        return  $business ? $business->verified : "";
    }

    public function getStatusAttribute()
    {
        $status         =   Business::where('id', $this->business_id)->first();
        if($status ?? ''){
            if($status->active == '1'){
                return "Active";
            }else{
                return "Not Active";
            }
        }
        else{
            return "Not Active";
        }
    }
    
    public function getBusinessLastLogAttribute()
    {
        $business_last_log  =   Log::orderBy('id', 'DESC')
                                    ->where('business_id', $this->business_id)
                                    ->whereIn('action', ['Published', 'Published Renew', 'Drafted'])
                                    ->first();
        return $business_last_log ? $business_last_log->action : "";
    }
}
