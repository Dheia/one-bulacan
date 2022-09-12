<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'messages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'sender_name',
        'sender_email',
        'subject',
        'content',
        'status',
        'read_at'
    ];
    // protected $hidden = [];
    protected $dates = ['read_at'];
    protected $appends = ['is_read'];

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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeRead($query)
    {
        return $query->where('read_at', '!=', NULL);
    }

    public function scopeUnread($query)
    {
        return $query->where('read_at', NULL);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getStatusAttribute()
    {
        if($this->read_at !== NULL) {
            return 'READ';
        }

        return 'UNREAD';
    }

    public function getIsReadAttribute()
    {
        if($this->read_at !== NULL) {
            return true;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
