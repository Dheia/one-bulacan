<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use Carbon\Carbon;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use CrudTrait;
    use Searchable;
    use Sluggable;
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'businesses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'image_gallery' => 'array'
    ];
    protected $fillable = [
        'logo',
        'name', 
        'branch_name', 

        'business_owner_id',
        'referrer_user_id',

        'slug',

        // Address
        'address1', 
        'address2', 
        'location_id', 
        'baranggay_id',

        // Contact Details
        'telephone', 
        'mobile', 
        'email', 
        'website', 
        'contact_person', 
        'nature',

        // Social Media
        'facebook', 
        'twitter', 
        'instagram', 

        // Company Background
        'history',
        'description',
        'about',
        'purpose',  
        'vission',
        'mission',
        'core_values',  
        'goals',
        'key_process', 
        'scope_of_work', 
        'product_services', 
        'image_gallery', 
        'longitude', 
        'latitude', 
        'ad_promotion', 
        'branches',

        'status', 
        'category_id', 

        'active', 
        'drafted', 
        'verified', 
        'featured',

        'listing_type',

        'start_at', 
        'end_at', 
        'lenght_of_time'
    ];

    // protected $hidden = [];
    protected $dates = ['start_at', 'end_at'];
    protected $appends = [
        'complete_address',
        'baranggay_name',
        'location_name', 
        'category_name', 
        'category_slug', 
        'tag_category', 
        'tags', 
        'formatted_business_id',
        'products_name',
        'products_description',

        'clean_history',
        'clean_description',
        'clean_about',
        'clean_purpose',
        'clean_vision',
        'clean_mission',
        'clean_core_values',
        'clean_goals',
        'clean_products_description',

        'unique_visitor',
        'visit',

        'average_rating',

        'has_paybiz_wallet',
        'is_inclusive',
        'payment_minimum_amount',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function searchableAs()
    {
        return config('scout.prefix') . env('ALGOLIA_INDICES');
        // return config('scout.prefix').'businesses_test';
    }
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_name',
            ],
        ];
    }
    public function getSlugOrNameAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->name;
    }

    public function uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request            = \Request::instance();
        $attribute_value    = (array) $this->{$attribute_name};
        $files_to_clear     = $request->get('clear_'.$attribute_name);

        // if a file has been marked for removal,
        // delete it from the disk and from the db
        if ($files_to_clear) {
            $attribute_value = (array) $this->{$attribute_name};
            foreach ($files_to_clear as $key => $filename) {
                \Storage::disk($disk)->delete($filename);
                $attribute_value = Arr::where($attribute_value, function ($value, $key) use ($filename) {
                    return $value != $filename;
                });
            }
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                if ($file->isValid()) {
                    // 1. Generate a new file name
                    $new_file_name      = $file->getClientOriginalName();
                    // 2. Move the new file to the correct path
                    $file_path          = $file->storeAs($destination_path, $new_file_name, $disk);
                    // 3. Add the public path to the database
                    $attribute_value[]  = 'uploads/' . $file_path;
                }
            }
        }
        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }

    public static function getReferrerBusinesses()
    {
        if(backpack_user()->hasrole('Super-Admin'))
        {
            $businesses   =   Business::get();
        }
        else
        {
            $businesses   =   Business::where('referrer_user_id', backpack_user()->id)->get();
        }
        return $businesses;
    }

    public static function getReferrerActiveBusinesses()
    {
        if(backpack_user()->hasrole('Super-Admin'))
        {
            $activeBusinesses   =   Business::where('drafted', '=', 0)
                                        ->where('active', '=', 1)
                                        ->get();
        }
        else
        {
            $activeBusinesses   =   Business::where('referrer_user_id', backpack_user()->id)
                                        ->where('drafted', '=', 0)
                                        ->where('active', '=', 1)
                                        ->get();
        }
        return $activeBusinesses;
    }

    public static function getReferrerExpiredBusinesses()
    {
        if(backpack_user()->hasrole('Super-Admin'))
        {
            $expiredBusinesses  =   Business::where( 'end_at', '<', Carbon::now())
                                        ->where('drafted', '=', 0)
                                        ->where('active', '=', 1)
                                        ->get();
        }
        else
        {
            $expiredBusinesses  =   Business::where('referrer_user_id', backpack_user()->id)
                                        ->where( 'end_at', '<', Carbon::now())
                                        ->where('drafted', '=', 0)
                                        ->where('active', '=', 1)
                                        ->get();
        }
        return $expiredBusinesses;
    }

    public static function getReferrerPendingBusinesses()
    {
        if(backpack_user()->hasrole('Super-Admin'))
        {
            $pendingBusinesses  =   Business::where('active', '=', '0')->get();
        }
        else
        {
            $pendingBusinesses  =   Business::where('referrer_user_id', backpack_user()->id)
                                        ->where('active', '=', '0')
                                        ->get();
        }
        return $pendingBusinesses;
    }

    public static function getReferrerRenewalBusinesses()
    {
        $renewal_id = [];

        if(!backpack_user()->hasrole('Super-Admin'))
        {
            $renewals   =   Business::where('end_at', '>=', Carbon::now())
                                ->where('active', 1)
                                ->get();
        }
        else
        {
            $renewals   =   Business::where('referrer_user_id', backpack_user()->id)
                                ->where('end_at', '>=', Carbon::now())
                                ->where('active', 1)
                                ->get();
        }

        foreach($renewals as $renewal){
            if(($renewal->end_at < Carbon::now()) == true){
            }
            elseif(Carbon::now()->diffInMonths($renewal->end_at) <= 0)
            {
                $renewal_id[] = $renewal->id;
            }
        }

        $forrenewal_businesses = Business::whereIN('id',  $renewal_id)->get();
        return $forrenewal_businesses;
    }

    public function previewPage($crud = false)
    {
        $url = url($this->category_slug . '/' . $this->slug); 
        return '<a class="btn btn-sm btn-link" target="_blank" href="' . $url  . '" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Open it</a>';
    }

    public static function updateRecord($id)
    {
        $business = Business::find($id);
        return $business->save();
    }

    public function generatePaymentQr($slug, $size)
    {
        $url      = url($slug . '/online-payment');
        $qr_code  = \QrCode::size($size)->generate($url);
        return $qr_code;
    }

    /**
     * Abort If Not Referred By User and Has No Access To All Business
     */
    public static function referredByUserOr401($referrer_user_id)
    {
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            if($referrer_user_id != backpack_user()->id)
            {
                abort(401, 'You do not have the necessary permissions to perform this action.');
            }
        }
    }

    /**
     * Abort If Not Referred By User and Has No Access To All Business
     */
    public static function referredByUserOr403($referrer_user_id)
    {
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            if($referrer_user_id != backpack_user()->id)
            {
                abort(403, 'Unauthorized access - you do not have the necessary permissions to see this page.');
            }
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function owner()
    {
        return $this->belongsTo(BusinessOwner::class, 'business_owner_id');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function baranggay()
    {
        return $this->belongsTo(Baranggay::class);
    }

    public function category()
    
    {
        return $this->belongsTo(Category::class);
    }

    public function business_category()
    {
        return $this->belongsToMany('App\Models\Category', 'business_categories');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'business_tags');
    }

    public function featured_business()
    {
        return $this->hasOne(FeaturedBusiness::class);
    }

    public function business_visitor()
    {
        return $this->belongsToMany(BusinessVisitor::class);
    }

    public function productServices()
    {
        return $this->hasMany(ProductService::class);
    }

    public function hasFeatured()
    {
        return $this->hasOne(FeaturedBusiness::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function topReviews()
    {
        return $this->hasMany(Review::class)->limit(4);
    }

    public function paybizWallet()
    {
        return $this->hasOne(PaybizWallet::class);
    }

    public function paynamicsPayments()
    {
        return $this->morphToMany(PaynamicsPayment::class, 'paymentable');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActive ($query)
    {
        return $query->where('active', 1);
    }

    public function scopeDrafted ($query)
    {
        return $query->where('drafted', 1);
    }

    public function scopeInactive ($query)
    {
        return $query->where('active', '!=', 1);
    }

    public function scopePublished ($query)
    {
        return $query->where('drafted', '!=', 1);
    }

    public function scopeFeatured ($query)
    {
        return $query->where('featured', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getLogoAttribute ()
    {
        $disk   =   config('backpack.base.root_disk_name');

        if(isset($this->attributes['logo'])) {
            if($this->attributes['logo'] !== null){
                $photo = $this->attributes['logo'];
                if(file_exists($photo)) {
                    return $photo;
                } else {
                    return 'images/default_image.png';
                }
            } else {
                return 'images/default_image.png';
            }
        } else {
            return 'images/default_image.png';
        }
    }

    public function getHasPaybizWalletAttribute() 
    {
        $paybizWallet = $this->paybizWallet()->active()->first();
        return $paybizWallet ? true : false;
    }

    public function getIsInclusiveAttribute() 
    {
        $paybizWallet = $this->paybizWallet()->active()->first();
        if($paybizWallet) {
            return $paybizWallet->is_inclusive;
        }
        return 0;
    }

    public function getPaymentMinimumAmountAttribute() 
    {
        $paybizWallet = $this->paybizWallet()->active()->first();
        if($paybizWallet) {
            return $paybizWallet->minimum_amount ?? 0;
        }
        return 0;
    }

    public function getCompleteAddressAttribute()
    {
        return $this->address1 . ', ' . $this->baranggay_name . ', ' . $this->location_name. ',' . env("LOCATION");
    }

    public function getBaranggayNameAttribute() 
    {
        $baranggay_name = Baranggay::where('id',$this->baranggay_id)->first();
        return  $baranggay_name ? $baranggay_name->name: "";
    }

    public function getLocationNameAttribute() 
    {
        $location_name = Location::where('id',$this->location_id)->first();
        return  $location_name ? $location_name->name : "";
    }
    public function getCategoryNameAttribute() 
    {
        $category = $this->category()->first();
        return  $category ? $category->name : "";
    }
    public function getCategorySlugAttribute() 
    {
        $category = $this->category()->first();
        return  $category ? $category->slug : "";
    }
    public function getTagCategoryAttribute() 
    {
        $categories         =   [];
        $tag_category       =   [];
        $tag_categories     =   BusinessCategory::where('business_id',$this->id)->get();

        if(count($tag_categories)>0)
        {
            foreach($tag_categories as $tag){
                $categories[] = Category::where('id',$tag->category_id)->first();
            }
        }
        if(count($categories)>0)
        {
            foreach($categories as $category){
                $tag_category[] = $category->name. ' in '.$this->baranggay_name.', '.$this->location_name.',' . env("LOCATION");
            }
        }
        return $tag_category;
    }

    public function getTagsAttribute() 
    {
        $tags               =   [];
        $categories         =   [];
        $business_tags      =   BusinessTag::where('business_id',$this->id)->get();

        if(count($business_tags)>0)
        {
            foreach($business_tags as $business_tag){
                $categories[] = Tag::where('id',$business_tag->tag_id)->first();
            }
        }
        if(count($categories)>0)
        {
            foreach($categories as $category){
                $tags[] = $category->name. ' in '.$this->baranggay_name.', '.$this->location_name.', ' . env("LOCATION");
            }
        }
        return $tags;
    }

    public function getProductsNameAttribute()
    {
        $productServices    =   $this->productServices()->get();
        $productsName               =   [];

        if(count($productServices)>0)
        {
            foreach($productServices as $productService){
                $productsName[] = $productService->name. ' in '.$this->baranggay_name.', '.$this->location_name.', ' . env("LOCATION");
            }
        }
        // return $productServices->pluck('name');
        return $productsName;
    }

    public function getProductsDescriptionAttribute()
    {
        $productServices = $this->productServices()->get();
        return $productServices->pluck('description');
    }

    public function getCleanProductsDescriptionAttribute()
    {
        $productServices = $this->productServices()->get();
        return json_decode(strip_tags($productServices->pluck('description')));
    }

    public function getFormattedBusinessIdAttribute()
    {
        $year           =   $this->created_at->format('y');
        $month          =   $this->created_at->format('m');
        $id             =   str_pad($this->id,5,'0',STR_PAD_LEFT);
        $business_id    =   $year.$month.$id;

        return $business_id ? $business_id : "";
    }

    public function getStatusAttribute() 
    {
        $premium = FeaturedBusiness::where('business_id',$this->id)->first();

        if(! $premium) {
            return "LISTED";
        }

        if($premium->isActive == 0) {
            return "LISTED";
        }
        // IF 0 DAYS LEFT
        if(($premium->end_at < Carbon::now()) == true) {
            return "PREMIUM EXPIRED";
        }
        // IF LESSTHAN 2 WEEKS
        elseif(Carbon::now()->diffInMonths($this->end_at) == 0){
            return "PREMIUM FOR RENEWAL";
        }
        else{
            return "PREMIUM";
        }
    }

    public function getPaidAttribute()
    {
        $sale = Sale::where('business_id',$this->id)->first();
        return  $sale ? $sale->paid : "";
    }

    public function getVisitAttribute()
    {
        $visitors   =   BusinessVisitor::where('business_id', $this->id)->get();
        $count      =   collect($visitors)->sum('count');
        return $count;
    }
    
    public function getUniqueVisitorAttribute()
    {
        $visitors   =   BusinessVisitor::where('business_id', $this->id)->get();
        $count      =   count($visitors);
        return $count;
    }

    public function getLinkAttribute()
    {
        $link = $this->formatted_business_id.'/'.$this->slug.'/info';
        return $link;
    }

    public function getCleanHistoryAttribute()
    {
        return $this->history ? strip_tags($this->history) : null;
    }

    public function getCleanDescriptionAttribute()
    {
        return $this->description ? strip_tags($this->description) : null;
    }

    public function getCleanAboutAttribute()
    {
        return $this->about ? strip_tags($this->about) : null;
    }

    public function getCleanPurposeAttribute()
    {
        return $this->purpose ? strip_tags($this->purpose) : null;
    }

    public function getCleanMissionAttribute()
    {
        return $this->mission ? strip_tags($this->mission) : null;
    }

    public function getCleanVisionAttribute()
    {
        return $this->vission ? strip_tags($this->vission) : null;
    }

    public function getCleanCoreValuesAttribute()
    {
        return $this->core_values ? strip_tags($this->core_values) : null;
    }

    public function getCleanGoalsAttribute()
    {
        return $this->goals ? strip_tags($this->goals) : null;
    }

    public function getAverageRatingAttribute()
    {
        $average        = null;
        $total_ratings  = $this->reviews()->sum('rating');

        if($total_ratings > 0) {
            $average        = $total_ratings / $this->reviews()->count();
        }

        return $average ? $average : null; 
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageGalleryAttribute($value)
    {
        $name               =   Str::slug($this->name, '-');
        $attribute_name     =   "image_gallery";
        $disk               =   "public_folder";
        $destination_path   =   "businesses/" . $name . "/ImageGallery";
        // dd($value);
        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setLogoAttribute($value)
    {
        $name               =   Str::slug($this->name, '-');
        $attribute_name     =   "logo";
        $disk               =   config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        $destination_path   =   "public/uploads/businesses/" . $name . '/Logo'; // path relative to the disk above

        $attribute_logo_M   =   "logo_medium";
        $logo_medium_path   =   "public/uploads/businesses/" . $name . '/MediumLogo'; // path relative to the disk above

        $attribute_logo_S   =   "logo_small";
        $logo_small_path    =   "public/uploads/businesses/" . $name . '/SmallLogo'; // path relative to the disk above

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = 'images/default_image.png';
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image                              =   \Image::make($value)->encode('jpg', 90);
            $image_medium                       =   \Image::make($value)->resize(200, 200)->encode('jpg', 90);
            $image_small                        =   \Image::make($value)->resize(100, 100)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename                           =   md5($value.time()).'.jpg';
            $mediumname                         =   md5($value.time()).'.jpg';
            $smallname                          =   md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            \Storage::disk($disk)->put($logo_medium_path.'/'.$mediumname, $image_medium->stream());
            \Storage::disk($disk)->put($logo_small_path.'/'.$smallname, $image_small->stream());
            // 3. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path            =   Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name]  =   $public_destination_path.'/'.$filename;

            $public_medium_destination_path     =   Str::replaceFirst('public/', '', $logo_medium_path);
            $this->attributes[$attribute_logo_M]  =   $public_medium_destination_path.'/'.$mediumname;

            $public_small_destination_path      =   Str::replaceFirst('public/', '', $logo_small_path);
            $this->attributes[$attribute_logo_S]  =   $public_small_destination_path.'/'.$smallname;
        }
        elseif (Str::startsWith($value, 'uploads'))
        {
            $this->attributes[$attribute_name]  =   $value;
        }
        elseif ($value == null || $value == ''){
            $this->attributes[$attribute_name]    =   'images/default_image.png';
            $this->attributes[$attribute_logo_M]  =   'images/default_image_200x200.jpg';
            $this->attributes[$attribute_logo_S]  =   'images/default_image_100x100.jpg';
        }
        elseif($value == 'images/default_image.png'){
            $this->attributes[$attribute_name]    =   $value;
            $this->attributes[$attribute_logo_M]  =   'images/default_image_200x200.jpg';
            $this->attributes[$attribute_logo_S]  =   'images/default_image_100x100.jpg';
        }
    }
}
