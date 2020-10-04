<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'cus_name',
        'phone',
        'email',
        'address'
    ];
}
