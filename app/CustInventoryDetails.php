<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustInventoryDetails extends Model
{
    protected $guarded=[];

    public function custInventory()
    {
        return $this->belongsTo(CustInventory::class);
    }
}
