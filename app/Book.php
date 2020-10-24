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

    public function get_invoice()
    {
        return $this->hasMany('App\Invoice','book_id');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author','author_books')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category','category_books')->withTimestamps();
    }
}
