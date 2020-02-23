<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id', 'service_id', 'invoice_id'
    ];
}
