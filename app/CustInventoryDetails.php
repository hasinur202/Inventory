<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustInventoryDetails extends Model
{
    protected $fillable = [
        'cust_id',
        'pay',
    ];

    public function custInventory()
    {
        return $this->belongsTo(CustInventory::class);
    }
}
