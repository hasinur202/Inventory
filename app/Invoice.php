<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function get_book()
    {
        return $this->belongsTo('App\Book','book_id');
    }

}
