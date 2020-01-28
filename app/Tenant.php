<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{

    protected $fillable = [
        'property_id',
        'given_name',
        'family_name',
        'share_of_rent_in_gbp'
    ];

    public function renting()
    {
        return $this->belongsTo('App\Property');
    }
}
