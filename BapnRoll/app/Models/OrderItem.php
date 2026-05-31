<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['orders_id', 'products_id','quantity', 'price', 'subtotal'];

    public function orders(){
        return $this->belongsTo(Orders::class, 'orders_id');
    }
    public function products(){
        return $this->belongsTo(Products::class, 'products_id');
    }
}
