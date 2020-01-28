<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    protected $fillable = [
        'manager_id',
        'address_line_1',
        'address_line_2',
        'town',
        'county',
        'postcode',
        'monthly_rent_in_gbp'
    ];

    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id');
    }
    
    public function tenants()
    {
        return $this->hasMany('App\Tenant', 'property_id');
    }
}
