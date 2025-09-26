<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    public function edit(Request $request, $id)
    {
        $qty = $request->input('qty');
        $cartItemModel = CartItem::find($id);
        if ($qty >= 0) {
			$cartItemModel->product_quantity = $qty;
			$cartItemModel->save();
        }

        $cartItem = $cartItemModel;

        // $cartItems = CartItem::where('cart_id', $cartItem['cart_id'])->get();
        $cartItems = Cart::find($cartItem['cart_id'])->cartItems;//dd($cartItems);
        $productModel = DB::table('products');

        $data = [
        	'cartItems' => $cartItems,
        	'productModel' => $productModel,
        ];

        return view('admin.cart.list_cart_item', $data);
    }

    public function editTotal($id)
    {
        $cartItemModel = new CartItem();

        $cartItem = $cartItemModel->where('id', $id)->first();

        $cartItems = $cartItemModel->where('cart_id', $cartItem['cart_id'])->get();
        $total = 0;
        foreach ($cartItems as $item) {
        	$total += $item->product_price*$item->product_quantity;
        }

        $data = [
        	'total' => $total,
        ];

        $cart = Cart::find($cartItem->cart_id);
        $cart->total_price = $total;
        $cart->save();

        return view('admin.cart.list_cart_item_total', $data);
    }
}
