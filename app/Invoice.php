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
        'id', 'regular', 'customer_id', 'service_id'
    ];

    protected $casts = [
        'is_regular' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        
    ];

}
