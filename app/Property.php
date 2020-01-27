<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'town',
        'county',
        'postcode',
        'monthly_rent_in_gbp'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function tenants()
    {
        return $this->hasMany('App\Tenant');
    }
}
