<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_ref', 'total_price', 'total_discount', 'pay_mode', 'cus_name', 'invoice_serial'];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function get_book()
    {
        return $this->belongsTo('App\Book','book_id');
    }

}
