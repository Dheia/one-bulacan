<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Provider;

class User extends Authenticatable
{
    use CrudTrait; 
    use HasApiTokens, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $guard_name = 'backpack';
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
        'remember_token'
    ];
    protected $appends = ['referral_link', 'avatar'];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getReferralCodeWithLink() 
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
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getReferralLinkAttribute()
    {
        return url('registration?refcode='.$this->code);
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
}
