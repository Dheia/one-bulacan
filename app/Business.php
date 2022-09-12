<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class Business extends Authenticatable
{
    use CrudTrait; 
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'one-portal';
    protected $fillable = [
       'business_id', 'business_number', 'password', 'remember_token'
    ];
    protected $appends = ['name'];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function business ()
    {
        return $this->belongsTo("App\Models\Business");
    }

    public function getNameAttribute()
    {
        $business = $this->business()->first();
        return  $business ? $business->name : "-";
    }
}
