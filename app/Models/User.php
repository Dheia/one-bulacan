<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Provider;

class User extends Model
{
    use CrudTrait;
    use HasRoles;
    use HasApiTokens;
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $fillable = [
        'code', 
        'name', 
        'firstname', 
        'lastname', 
        'username', 
        'mobile', 
        'address', 
        'email', 
        'email_verified_at', 
        'password',
        'is_admin',
        'is_first_time_login',
    ];
    protected $hidden = ['password'];
    // protected $dates = [];
    protected $appends = ['referral_link', 'avatar'];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getReferralLink() 
    {
        return '<a href="'.url('?referral_code='.$this->code).'" target="_blank">'.$this->referral_link.'</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'referrer_user_id');
    }

    public function providers()
    {
        return $this->hasMany(Provider::class, 'user_id', 'id');
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
    public function getReferralLinkAttribute()
    {
        return url('?referral_code='.$this->code);
    }

    public function getAvatarAttribute()
    {
        $providers = $this->providers()->first();
        if(! $providers) {
            return 'images/headshot-default.png';
        }
        $image_path = 'uploads/users/' . $providers->provider . '/' . $providers->provider_id . '.jpg';
        return $image_path;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
