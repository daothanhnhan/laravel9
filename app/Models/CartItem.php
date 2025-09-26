<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'product_price', 'product_quantity', 'product_price_total', 'color', 'size'];

    public function cart () 
    {
    	return $this->belongTo(Cart::class);
    }
}
