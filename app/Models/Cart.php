<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'note', 'note_cart', 'state', 'creator_id', 'total_price', 'total_item'];

    public function cartItems () 
    {
    	return $this->hasMany(CartItem::class);
    }
}
