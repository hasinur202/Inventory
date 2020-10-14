<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppIventory extends Model
{
    protected $fillable = [
        'invoice_ref',
        'total_due',
        'total_paid',
        'new_due',
        'supplier',
        'consign_ref'
    ];
}
