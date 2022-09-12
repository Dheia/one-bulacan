<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class PaymentMethod extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use RevisionableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'payment_methods';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'payment_category_id',
        'name',
        'code',
        'icon',
        'logo',
        'description',
        'fee',
        'additional_fee',
        'minimum_fee',
        'active'
    ];
    // protected $hidden = [];
    // protected $dates = [];

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
    public function paymentCategory()
    {
        return $this->belongsTo(PaymentCategory::class);
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

    public function scopeInactive ($query)
    {
        return $query->where('active', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getIcon()
    {
        return '<i class="fa ' . $this->icon . '"></i>';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setFeeAttribute($value)
    {
        $this->attributes['fee'] = $value === null ? '0' : $value;
    }

    public function setAdditionalFeeAttribute($value)
    {
        $this->attributes['additional_fee'] = $value === null ? '0' : $value;
    }

    public function setMinimumFeeAttribute($value)
    {
        $this->attributes['minimum_fee'] = $value === null ? '0' : $value;
    }
}
