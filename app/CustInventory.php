<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustInventory extends Model
{
    protected $fillable = [
        'invoice_ref',
        'total_due',
        'total_paid',
        'new_due',
        'cus_name'
    ];


    public function custInventoryDetails()
    {
        return $this->hasMany(CustInventoryDetails::class);
    }
}
