<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUser extends Model
{

    protected $table=[
        'product_user'
    ];
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'special_price',
    ];

}
