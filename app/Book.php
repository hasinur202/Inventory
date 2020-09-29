<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded=[];

    public function get_consignment()
    {
        return $this->hasMany('App\Consignment','book_id');
    }
}
