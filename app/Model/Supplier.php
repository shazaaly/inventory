<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'id', 'name', 'email', 'address', 'phone', 'photo', 'shop_name'];
}
