<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{

    protected $fillable = [
        'property_id',
        'share_of_rent_in_gbp'
    ];

    

    public function renting()
    {
        return $this->belongsTo('App\Property');
    }
    
    public function manager()
    {
        return $this->belongsTo('App\User', null, 'manager_id');
    }
}
