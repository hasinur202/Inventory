<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_ref', 'consign_ref', 'cus_id', 'total_price', 'pay_mode'];
}
