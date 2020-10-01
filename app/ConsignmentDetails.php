<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsignmentDetails extends Model
{
    protected $fillable = [
        'consignment_id',
        'book_id',
        'cost_price',
        'pub_price',
        'sales_price',
        'qty',
    ];


    public function consignment()
    {
        return $this->belongsTo(Consignment::class);
    }
}
