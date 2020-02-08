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
        'id', 'regular', 'customer_id'
    ];

    protected $casts = [
        'is_regular' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'invoice_services');
    }

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        
    ];

}
