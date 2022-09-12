<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Job extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'jobs';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'business_id', 
        'company_name', 
        'job_category_id', 
        'position', 
        'description', 
        'requirement', 
        'qualification', 
        'quantity', 
        'local', 
        'contact_person', 
        'contact_number', 
        'registered', 
        'start_at', 
        'end_at', 
        'active'
    ];
    // protected $hidden = [];
    protected $dates = ['start_at', 'end_at'];
    protected $appends = ['business_name', 'category_slug', 'logo', 'email', 'mobile', 'slug'];

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
    public function job_category() {
        return $this->belongsTo('App\Models\JobCategory', 'job_category_id');
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
        if($this->business_id ?? ''){
            $business_name = Business::where('id',$this->business_id)->first();
            return $business_name ? $business_name->name: "";
        }else{
            return $this->company_name;
        }
       
    }
    public function getAddressAttribute() 
    {
        if($this->business_id ?? ''){
            $business = Business::where('id',$this->business_id)->first();
            $location_name = Location::where('id',$business->location_id)->first();
            $baranggay_name = Baranggay::where('id',$business->baranggay_id)->first();
            
            return $location_name ? $business->address1. ', '.$location_name->name.', '.$baranggay_name->name: "";
        }
        else{
            return '';
        }
    }
    public function getMobileAttribute() 
    {
        if($this->business_id ?? ''){
            $business = Business::where('id',$this->business_id)->first();
            
            return $business ? $business->mobile: "";
        }
        else{
            return '';
        }
    }

    public function getEmailAttribute() 
    {
        if($this->business_id ?? ''){
            $business = Business::where('id',$this->business_id)->first();
            
            return $business ? $business->email: "";
        }
        else{
            return '';
        }
    }

    public function getLogoAttribute() 
    {
        if($this->business_id ?? ''){
            $business       =   Business::where('id',$this->business_id)->first();
            $location_name  =   Location::where('id',$business->location_id)->first();
            $baranggay_name =   Baranggay::where('id',$business->baranggay_id)->first();
            
            return  $business ? $business->logo: "";
        }
        else{
            return 'images/default_image.png';
        }
    }
    public function getStatusAttribute() 
    {
        $status = Job::where('id',$this->id)->first();
        // IF 0 DAYS LEFT
        if($status->active == '0')
        {
            return "NOT ACTIVE";
        }
        if(($status->end_at <= Carbon::now()) == true)
        {
            return "EXPIRED";
        }
        else{
            return "ACTIVE";
        }
    }
    public function getCategorySlugAttribute() 
    {
        $business       =   Business::where('id',$this->business_id)->first();
        $category_slug  =   Category::where('id',$business->category_id)->first();
        return  $category_slug ? $category_slug->slug : "";
    }
    public function getSlugAttribute() 
    {
        if($this->business_id ?? ''){
            $business   =   Business::where('id',$this->business_id)->first();
            
            return  $business ? $business->slug: "";
        }
        else{
            return '';
        }
    }
}
