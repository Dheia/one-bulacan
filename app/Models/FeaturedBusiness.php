<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FeaturedBusiness extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'featured_businesses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id', 'business_id', 'start_at', 'end_at', 'lenght_of_time', 'isActive'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['start_at', 'end_at'];
    protected $appends = ['status'];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getReferrerActiveFeatured()
    {
        $referrerBusinesses     =   Business::getReferrerBusinesses();
        $activeFeatured         =   FeaturedBusiness::whereIn('business_id',$referrerBusinesses->pluck('id'))
                                        ->where('end_at', '>=', Carbon::now())
                                        ->where('isActive', 1)
                                        ->get();
        return $activeFeatured;
    }

    public static function getReferrerNotActiveFeatured()
    {
        $referrerBusinesses     =   Business::getReferrerBusinesses();
        $notActiveFeatured      =   FeaturedBusiness::whereIn('business_id',$referrerBusinesses->pluck('id'))
                                        ->where('isActive', 0)
                                        ->get();
        return $notActiveFeatured;
    }

    public static function getReferrerExpiredFeatured()
    {
        $referrerBusinesses     =   Business::getReferrerBusinesses();
        $expiredFeatured        =   FeaturedBusiness::whereIn('business_id',$referrerBusinesses->pluck('id'))
                                        ->where( 'end_at', '<', Carbon::now())
                                        ->where('isActive', 1)
                                        ->get();
        return $expiredFeatured;
    }

    public static function getReferrerRenewalFeatured()
    {
        $referrerBusinesses     =   Business::getReferrerBusinesses();

        $renewal_id             =   [];
        $renewals               =   FeaturedBusiness::whereIn('business_id',$referrerBusinesses->pluck('id'))
                                        ->where('end_at', '>=', Carbon::now())
                                        ->where('isActive', 1)
                                        ->get();
        foreach($renewals as $renewal){
            if(($renewal->end_at < Carbon::now()) == true){
            }
            elseif(Carbon::now()->diffInWeeks($renewal->end_at) <= 1)
            {
                $renewal_id[]   =   $renewal->id;
            }
        }
        $renewal                =   FeaturedBusiness::whereIN('id',  $renewal_id)->get();

        return $renewal;
    }

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
    public function scopeActive ($query)
    {
        return $query->where('isActive', 1);
    }

    public function scopeInactive ($query)
    {
        return $query->where('isActive', '!=', 1);
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getBusinessNameAttribute() 
    {
        $business_name = Business::where('id',$this->business_id)->first();
        
        return  $business_name ? $business_name->name: "";
    }

    public function getStatusAttribute() 
    {
        $status = FeaturedBusiness::where('id',$this->id)->first();

        if($status->isActive == 0)
        {
            return "NOT ACTIVE";
        }
        // IF 0 DAYS LEFT
        if(($status->end_at < Carbon::now()) == true)
        {
            return 'EXPIRED';
        }
        // IF LESSTHAN 2 WEEKS
        elseif(Carbon::now()->diffInWeeks($status->end_at) <= 1)
        {
            return "FOR RENEWAL";
        }
        else
        {
            return "ACTIVE";
        }
    }

    public function getRemainingWeeksAttribute()
    {
        if(($this->end_at < Carbon::now()) == true)
        {
            return '-';
        }

        $weeks = $this->end_at->diffInWeeks(Carbon::now());
        return $weeks ? $weeks . ' weeks' : '1 week';
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
