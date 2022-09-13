<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use CrudTrait;
    use Sluggable;
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $appends = ['parent_name','parent_slug'];
    protected $fillable = ['name', 'icon', 'image', 'slug', 'parent_id', 'active'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
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

    public static function getTree()
    {
        $menu = self::orderBy('name', 'ASC')->get();

        if ($menu->count()) {
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);

                foreach ($menu as $i => $menu_subitem) {
                    if ($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }
        return $menu;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function parent() {
        // return $this->belongsToMany(Category::class);
        return $this->belongsTo(Category::class);
    }
    public function children() {
        // return $this->belongsToMany(Category::class);
        return $this->hasMany(Category::class);
    }
    public function business_category() {
        return $this->belongsToMany('App\Models\Business', 'business_categories');
    }
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    public function businesses()
    {
        return $this->hasMany(Business::class);
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

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getParentSlugAttribute() {
        $parent_slug = Category::where('id',$this->parent_id)->first();
        return  $parent_slug ? $parent_slug->slug : "";
    }
    public function getParentNameAttribute() {
        $parent_name = Category::where('id',$this->parent_id)->first();
        return  $parent_name ? $parent_name->name : "";
    }
    public function getBusinessesAttribute(){
        $businesses = Business::where('category_id', $this->id)->get();
        return $businesses ? $businesses : "";
    }
    public function getImageAttribute (){
        $disk = config('backpack.base.root_disk_name');
        if(isset($this->attributes['image'])) {
            if($this->attributes['image'] !== null){
                $image = $this->attributes['image'];
                if(file_exists($image)) {
                    return $image;
                } else {
                    return 'v2/content/one/images/one-logo.png1';
                }
            } else {
                return 'v2/content/one/images/one-logo.png2';
            }
        } else {
            return 'v2/content/one/images/one-logo.png3';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    // public function setImageAttribute($value)
    // {
    //     $attribute_name = "image";
    //     $disk = config('public_folder'); // or use your own disk, defined in config/filesystems.php
    //     $destination_path = "public/uploads/images/CategoryLogo"; // path relative to the disk above

    //     // if the image was erased
    //     if ($value==null) {
    //         // delete the image from disk
    //         \Storage::disk($disk)->delete($this->{$attribute_name});

    //         // set null in the database column
    //         $this->attributes[$attribute_name] = null;
    //     }

    //     // if a base64 was sent, store it in the db
    //     if (Str::startsWith($value, 'data:image'))
    //     {
    //         // 0. Make the image
    //         $image = \Image::make($value)->encode('jpg', 90);

    //     // 1. Generate a filename.
    //         $filename = md5($value.time()).'.jpg';

    //     // 2. Store the image on disk.
    //         \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

    //     // 3. Delete the previous image, if there was one.
    //         \Storage::disk($disk)->delete($this->{$attribute_name});

    //         // 4. Save the public path to the database
    //     // but first, remove "public/" from the path, since we're pointing to it from the root folder
    //     // that way, what gets saved in the database is the user-accesible URL
    //         $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
    //         $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

    //     }
    // }
   
}
