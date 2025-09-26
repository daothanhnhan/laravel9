<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index () 
    {
    	$data = [
    		'carts' => Cart::paginate(20),
    	];
    	$data['menu_active'] = Together::check_url_menu();
        return view('admin.cart.list', $data);
    }

    public function search (Request $request) 
    {
    	$q = $request->query('q');
        $q = str_replace(" ", "-", $q);
        $q = str_replace("+", "-", $q);
        $q = urldecode($q);
        // $q = Str::slug($q);
        $q_arr = explode("-", $q);

        if (count($q_arr) == 1) {
        	$like = '%'.$q.'%';
            $cartModel = Cart::where('name', 'like', $like);
            $cartModel = $cartModel->orWhere('id', 'like', $like);
            $cartModel = $cartModel->orWhere('phone', 'like', $like);
            $cartModel = $cartModel->orWhere('email', 'like', $like);
        } else {
        	$cartModel = new Cart();
            foreach ($q_arr as $slug) {
            	$like = '%'.$slug.'%';
                $cartModel = $cartModel->where('name', 'like', $like);
            }
        }

        $cartModel = $cartModel->orderBy('id');
        $cartModel = $cartModel->paginate(20)->appends(['q' => $q]);

    	$data = [
    		'carts' => $cartModel,
    	];
    	$data['menu_active'] = Together::check_url_menu();
        return view('admin.cart.list', $data);
    }

    public function show (Cart $cart) 
    {
    	return redirect('admin/carts/'.$cart['id'].'/edit');
    }

    public function edit (Cart $cart) 
    {
    	$config = DB::table('configs')->find(1);
        $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        $productModel = DB::table('products');

        $data = [
            'config' => $config,
            'cart' => $cart,
            'cartItems' => $cartItems,
            'productModel' => $productModel,
        ];
        $data['menu_active'] = Together::check_url_menu();

        return view('admin.cart.edit', $data);
    }

    public function update (Request $request, Cart $cart) 
    {
        $cart->note = $request->input('note');
        $cart->state = $request->input('state');
        $cart->save();

        $errors = ['Cập nhập thành công'];
        return redirect('admin/carts/'.$cart->id.'/edit')
                        ->withErrors($errors);
    }

    public function destroy (Cart $cart) 
    {
    	$cart->delete();
        return redirect('admin/carts');
    }
}
