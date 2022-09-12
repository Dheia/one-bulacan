<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class PaybizWallet extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use RevisionableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'paybiz_wallets';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'business_id',
        'biz_wallet_id',
        'descriptor_note',
        'minimum_amount',
        'is_inclusive',
        'active'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['is_exclusive'];

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
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    public function scopeInclusive($query)
    {
        return $query->where('is_inclusive', 1);
    }

    public function scopeExclusive($query)
    {
        return $query->where('is_inclusive', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getIsExclusiveAttribute()
    {
        return $this->is_inclusive ? 0 : 1;
    }

    public function getRenderedQrCodeAttribute() 
    {
        $business = $this->business()->first();
        if($business) {
            $url      = url($business->slug . '/online-payment');
            $qrCode = \QrCode::size(150)->generate($url);
            return $qrCode;
        } else {
            return null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
