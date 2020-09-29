<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    public function get_book()
    {
        return $this->belongsTo('App\Book','book_id');
    }

    public function get_supplier()
    {
        return $this->belongsTo('App\Supplier','supplier_id');
    }
}
