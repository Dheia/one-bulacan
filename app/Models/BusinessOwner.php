<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessOwner extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected static function boot() {
        parent::boot();
        
        // Delete Credential If Business Owner is Deleted
        BusinessOwner::deleted(function($businessOwner) {
            $businessOwner->credential()->delete();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'business_owners';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'image',
        'telephone',
        'mobile',
        'email',
        'gender',
        'active'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = [ 'fullname' ];

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
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function credential()
    {
        return $this->hasOne(BusinessCredential::class);
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
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name     =   "image";
        $disk               =   config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        $destination_path   =   "public/uploads/images/businessOwners/"; // path relative to the disk above

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = 'images/headshot-default.png';
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image                              =   \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename                           =   md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path            =   Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name]  =   $public_destination_path.'/'.$filename;
        }
        elseif (Str::startsWith($value, 'uploads'))
        {
            $this->attributes[$attribute_name]  =   $value;
        }
        elseif ($value == null || $value == ''){
            $this->attributes[$attribute_name]  =   'images/headshot-default.png';
        }
        elseif($value == 'images/headshot-default.png'){
            $this->attributes[$attribute_name]  =   $value;
        }
    }
}
