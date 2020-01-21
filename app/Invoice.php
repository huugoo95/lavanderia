<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id', 'occasional'
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    
    public function service()
    {
        return $this->hasOne('App\Service');
    }

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        
    ];
}
