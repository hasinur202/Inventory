<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustInventory extends Model
{
    protected $guarded=[];


    public function custInventoryDetails()
    {
        return $this->hasMany(CustInventoryDetails::class);
    }
}
