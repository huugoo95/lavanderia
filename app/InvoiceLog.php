<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceLog extends Model
{
    protected $fillable = [
        'id', 'created_at', 'invoice_id',
    ];
}
