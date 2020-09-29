<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function get_consignment()
    {
        return $this->hasMany('App\Consignment','supplier_id');
    }
}
