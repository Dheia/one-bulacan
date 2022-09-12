<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\Category;
use Laravel\Scout\Searchable;


class Directory extends Model
{
    use CrudTrait;
    use Searchable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'directories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $appends = ['category_name', 'location_name'];
    protected $guarded = ['id'];
    // protected $fillable = ['directoryable_id','directoryable_type'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function searchableAs()
    {
        return 'directory';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function tags(){
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function location() {
        return $this->belongsTo('App\Models\Location');
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

    public function getLocationNameAttribute(){
        $location = Location::where('id',$this->location_id)->first();

        if($location) {
            return $location->name;
        }
    }

    public function getCategoryNameAttribute(){
        $category = Category::where('id',$this->category_id)->first();

        if($category) {
            return $category->name;
        }
    }


    

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setLogoAttribute($value)
    {
        $attribute_name = "logo";
        $disk = config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        $destination_path = "public/uploads/directory/images"; // path relative to the disk above

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it from the root folder
        // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setSlugAttribute($value) {
        $location = Location::where('id', $this->location_id)->first();
        $category = Category::where('id', $this->category_id)->first();

        $this->attributes['slug'] = Str::slug(strtolower($location->name) . " " . strtolower($category->name) . " " . strtolower($this->name));
    }


}
