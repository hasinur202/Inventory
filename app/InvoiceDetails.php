<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $fillable = [
        'invoice_id',
        'book_id',
        'pub_price',
        'qty',
        'rate',
        'unit_price',
        'total_price',
    ];
}
