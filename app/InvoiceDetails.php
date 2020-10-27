<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $fillable = [
        'invoice_id',
        'book_id',
        'consign_ref',
        'pub_price',
        'cost_price',
        'qty',
        'rate',
        'discount_p',
        'unit_price',
        'total_price',
        'total_costprice',
        'total_dis'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
