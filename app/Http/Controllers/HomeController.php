<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Cart;
use App\Models\CartItem;
use App\Events\CartProcessed;

class HomeController extends Controller
{
    public $menu_str;

    public function get_info_main () {
        $config = DB::table('configs')->find(1);
        $data = [
            'embed_code_header' => $config->embed_code_header,
            'embed_code_footer' => $config->embed_code_footer,
        ];
        return $data;
    }

    public function index()
    {
        $config = DB::table('configs')->find(1);
        $footer_productcat = DB::table('product_cats')->get();
        $slides = DB::table('slides')->orderBy('sort')->get();
        $products = DB::table('products')->orderByDesc('id')->take(12)->get();
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $posts = DB::table('posts')->orderByDesc('id')->take(4)->get();
        $videos = DB::table('videos')->orderBy('id')->take(4)->get();

        foreach ($videos as $key => $video) {
            $video_new = preg_replace('/height="\d+"/', "height='450'",$video->content);
            $video_new = preg_replace('/width="\d+"/', "width='100%'",$video_new);
            $videos[$key]->content = $video_new;
        }

        $data = [
            'head_title' => $config->title,
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'head_icon' => $config->icon,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'home_slides' => $slides,
            'home_banner_1' => $config->banner_1,
            'home_banner_2' => $config->banner_2,
            'home_banner_3' => $config->banner_3,
            'home_products' => $products,
            'home_productcats' => $productCats,
            'home_posts' => $posts,
            'home_videos' => $videos,

        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);//dd($data);

        return view('home.index', $data);
    }

    public function page ($slug) {
        $page = DB::table('pages')->where('slug', $slug)->first();

        if (empty($page)) {
            return redirect()->to('/');
        }
        
        $data = [
            'head_title' => $page->title_seo,
            'breadcrumb_title' => $page->title,
            'head_des' => $page->des_seo,
            'head_keyword' => $page->keyword,
            'og_image' => '/storage/uploads/page/'.$page->image,
            
            'page_item' => $page,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home/page/page', $data);
    }

    public function productAll () {
        $config = DB::table('configs')->find(1);
        
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        $productModel = DB::table('products')->orderByDesc('id')->Paginate(6);
        
        $data = [
            'head_title' => 'Tất cả sản phẩm',
            'breadcrumb_title' => 'Tất cả sản phẩm',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,

            'products' => $productModel,

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function productCat ($slug) {
        $productCat = DB::table('product_cats')->where('slug', $slug)->first();
        if (empty($productCat)) {
            return redirect()->to('/');
        }

        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        $match = '%'.$productCat->id.'%';
        $productModel = DB::table('products')->where('productcat_id', 'like', $match)->orderByDesc('id')->paginate(6);
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        
        
        $data = [
            'head_title' => $productCat->title_seo,
            'breadcrumb_title' => $productCat->title,
            'head_des' => $productCat->des_seo,
            'head_keyword' => $productCat->keyword,
            'og_image' => '/storage/uploads/productcat/'.$productCat->image,

            'products' => $productModel,

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function productSale () {
        $config = DB::table('configs')->find(1);
        
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        $productModel = DB::table('products')->where('price_sale', '!=', 0)->orderByDesc('id')->paginate(6);

        $data = [
            'head_title' => 'Sản phẩm Sale',
            'breadcrumb_title' => 'Sản phẩm Sale',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'products' => $productModel,

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function searchProduct (Request $request) {
        $config = DB::table('configs')->find(1);
        
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        
        // bỏ khoảng trống, dấu +, chuyển sang dạng chữ, bỏ dấu
        $q = $request->query('q');//dd($uri);
        $q = str_replace(" ", "-", $q);
        $q = str_replace("+", "-", $q);
        $q = urldecode($q);
        $q = Str::slug($q);
        $q_arr = explode("-", $q);

        $like = '%'.$q_arr[0].'%';
        $productModel = DB::table('products')->where('slug', 'like', $like);
        // $productModel = Product::where('slug', 'like', $like);
        unset($q_arr[0]);
        foreach ($q_arr as $item) {
            $like = '%'.$item.'%';
           $productModel = $productModel->where('slug', 'like', $like);
        }
        
        $productModel = $productModel->orderByDesc('id')->paginate(6)->appends(['q' => $q]);
        // dd($productModel);
        
        $data = [
            'head_title' => 'Tìm kiếm Sản phẩm',
            'breadcrumb_title' => 'Tìm kiếm Sản phẩm',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'products' => $productModel,

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function filter () {
        $config = DB::table('configs')->find(1);
        
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        
        $uri = url()->full();
        $uri = explode("?", $uri)[1];
        $uri = explode("&", $uri);
        // dd($uri);
        $query = [];
        foreach ($uri as $uri_item) {
            // $pos = strpos($uri_item, 'hang');var_dump($pos);
            if (strpos($uri_item, 'hang') !== false) {
                $hang = str_replace("hang=", "", $uri_item);//dd($hang);
                $query['hang'] = $hang;
            }

            if (strpos($uri_item, 'gioitinh') !== false) {
                $gioitinh = str_replace("gioitinh=", "", $uri_item);
                $query['gioitinh'] = $gioitinh;
            }

            if (strpos($uri_item, 'size') !== false) {
               $size = str_replace("size=", "", $uri_item);
               $query['size'] = $size;
            }

            if (strpos($uri_item, 'gia') !== false) {
               $gia = str_replace("gia=", "", $uri_item);
               $query['gia'] = $gia;
            }
        }
        // dd('stop');

        $match = '%"'.$hang.'"%';
        $productModel = DB::table('products')->where('productcat_id', 'like', $match);

        if ($gioitinh != '') {
            $productModel = $productModel->where('product_text_1', $gioitinh);
        }

        if ($size != '') {
            $match_size = '%'.$size.'%';
            $productModel = $productModel->where('product_size', 'like', $match_size);
        }

        if ($gia != '') {
            if ($gia == 1) {
                $productModel = $productModel->where('price', '<', '1000000');
            }
            if ($gia == 2) {
                $productModel = $productModel->where('price', '>=', '1000000');
                $productModel = $productModel->where('price', '<=', '1500000');
            }
            if ($gia == 3) {
                $productModel = $productModel->where('price', '>', '1500000');
            }
        }

        $productModel = $productModel->orderByDesc('id');
        // $productModel = $productModel->orderByDesc('id')->dd();
        
        $data = [
            'head_title' => 'Tìm kiếm Sản phẩm',
            'breadcrumb_title' => 'Tìm kiếm Sản phẩm',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,

            'products' => $productModel->paginate(6)->appends($query),

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function filterPrice (Request $request) {
        $config = DB::table('configs')->find(1);
        
        $productCats = DB::table('product_cats')->orderBy('id')->get();
        $product_new = DB::table('products')->where('product_new', 1)->orderByDesc('id')->take(4)->get();
        
        // bỏ chữ đ, khoản trống, dấu +
        $price = $request->query('price');
        $price = str_replace("đ", "", $price);
        $price = str_replace("%C4%91", "", $price);
        $price = str_replace(" ", "", $price);
        $price = str_replace("+", "", $price);
        $price_q = $price;
        $price = explode("-", $price);

        $productModel = DB::table('products');
        $productModel = $productModel->where('price', '>=', $price[0]);
        $productModel = $productModel->where('price', '<=', $price[1]);

        $productModel = $productModel->orderByDesc('id');
        
        $data = [
            'head_title' => 'Tìm kiếm Sản phẩm theo giá',
            'breadcrumb_title' => 'Tìm kiếm Sản phẩm theo giá',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'products' => $productModel->paginate(6)->appends(['price' => $price_q]),

            'sidebar_productcat' => $productCats,
            'sidebar_product_new' => $product_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.products', $data);
    }

    public function product ($slug) {
        $product = DB::table('products')->where('slug', $slug)->first();//dd($post);
        if (empty($product)) {
            return redirect()->to('/');
        }

        $product_img_sub = json_decode($product->image_sub, true);
        $product_size = explode(",", $product->product_size);

        // dd($product->productcat_id);
        if (empty($product->productcat_id)) {
            $product_relate = DB::table('products')->orderByDesc('id')->take(6)->get();
        } else {
            $productcat_id = json_decode($product->productcat_id, true);
            if (empty($productcat_id)) {
                $product_relate = DB::table('products')->orderByDesc('id')->take(6)->get();
            } else {
                $productcat_id_one = $productcat_id[0];
                $match = '%"'.$productcat_id_one.'"%';
                $product_relate = DB::table('products')->where('productcat_id', 'like', $match)->orderByDesc('id')->take(6)->get();
            }
        }
        
        $data = [
            'head_title' => $product->title_seo,
            'breadcrumb_title' => $product->title,
            'head_des' => $product->des_seo,
            'head_keyword' => $product->keyword,
            'og_image' => '/storage/uploads/product/'.$product->image,

            'product' => $product,
            'product_img_sub' => $product_img_sub,
            'product_size' => $product_size,
            'product_relate' => $product_relate,

        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.product', $data);
    }

    public function addCartHome (Request $request) {
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_img = $request->input('product_img');
        $product_price = $request->input('product_price');
        $product_quantity = $request->input('product_quantity');
        $product_size = $request->input('product_size');

        // session(['key' => 'value']);
        // nếu có , kiểm tra nếu trống thì tạo như mói,
        // lướt một lượt nếu chưa có thì thêm mới, có rồi thì bỏ qua.
        // kiểm tra id và size.
        // nếu chưa có thì tạo mới.
        if ($request->session()->has('shopping_cart')) {
            if (empty($request->session()->get('shopping_cart'))) {
                $newdata['shopping_cart'][] = [
                    'product_id'  => $product_id,
                    'product_name'     => $product_name,
                    'product_img'     => $product_img,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity,
                    'product_size' => $product_size,
                ];
                session($newdata);
            } else {
                // lưu vào 1 biến rồi xóa session đi
                // xử lý rồi lưu lại session
                $carts = $request->session()->get('shopping_cart');
                $request->session()->forget('shopping_cart');
                $add = 1;
                foreach ($carts as $key => $cart) {
                    if ($cart['product_id'] == $product_id && $cart['product_size'] == $product_size) {
                        $add = 0;
                        $product_quantity_2 = $carts[$key]['product_quantity'] + $product_quantity;
                        $carts[$key]['product_quantity'] = $product_quantity_2;
                    }
                }

                if ($add == 1) {
                    $newdata = [
                        'product_id'  => $product_id,
                        'product_name'     => $product_name,
                        'product_img'     => $product_img,
                        'product_price' => $product_price,
                        'product_quantity' => $product_quantity,
                        'product_size' => $product_size,
                    ];

                    $carts[] = $newdata;
                }
                session(['shopping_cart' => $carts]);
                // return json_encode($carts);
            }
        } else {
            $newdata['shopping_cart'][] = [
                'product_id'  => $product_id,
                'product_name'     => $product_name,
                'product_img'     => $product_img,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity,
                'product_size' => $product_size,
            ];
            session($newdata);
        }

        $json = json_encode($request->session()->get('shopping_cart'));
        // $json = '{}';
        return $json;
    }

    public function viewCart (Request $request) {
        $config = DB::table('configs')->find(1);

        $session = $request->session();
        $total_cart = 0;
        $total_item = 0;
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                foreach ($session->get('shopping_cart') as  $cart) {
                    $total_cart += $cart['product_price'] * $cart['product_quantity'];
                    $total_item++;
                }
            }
        }

        $carts = [];
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                $carts = session('shopping_cart');
            }
        }
        
        $data = [
            'head_title' => 'Giỏ hàng',
            'breadcrumb_title' => 'Giỏ hàng',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'carts' => $carts,
            'total_cart' => $total_cart,
            'total_item' => $total_item,

        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.cart', $data);
    }

    public function cartChangeQuantity (Request $request) {
        $state = $request->input('state');
        $product_id = $request->input('product_id');
        $product_size = $request->input('product_size');
        // độ giảm nhỏ nhất là 1 nếu nhỏ hơn 1 thì bỏ qua

        $carts = $request->session()->get('shopping_cart');
        $request->session()->forget('shopping_cart');
        foreach ($carts as $key => $cart) {
            if ($cart['product_id'] == $product_id && $cart['product_size'] == $product_size) {
                if ($state == 'minus') {
                    if ($cart['product_quantity'] > 1) {
                        $product_quantity_2 = $cart['product_quantity'] - 1;
                        $carts[$key]['product_quantity'] = $product_quantity_2;
                    }
                }

                if ($state == 'plus') {
                    $product_quantity_2 = $cart['product_quantity'] + 1;
                    $carts[$key]['product_quantity'] = $product_quantity_2;
                }
            }
        }
        session(['shopping_cart' => $carts]);

        $session = $request->session();
        $total_cart = 0;
        $total_item = 0;
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                foreach ($session->get('shopping_cart') as  $cart) {
                    $total_cart += $cart['product_price'] * $cart['product_quantity'];
                    $total_item++;
                }
            }
        }

        $data = [
            'carts' => session('shopping_cart'),
            'total_cart' => $total_cart,
            'total_item' => $total_item,
        ];

        return view('home.ajax.ajax_cart', $data);
        // return '<h1>tuan</h1>';
    }

    public function cartDelItem (Request $request) {
        $product_id = $request->input('product_id');
        $product_size = $request->input('product_size');
        // độ giảm nhỏ nhất là 1 nếu nhỏ hơn 1 thì bỏ qua

        $carts = $request->session()->get('shopping_cart');
        $request->session()->forget('shopping_cart');
        foreach ($carts as $key => $cart) {
            if ($cart['product_id'] == $product_id && $cart['product_size'] == $product_size) {
                unset($carts[$key]);
            }
        }
        session(['shopping_cart' => $carts]);

        $session = $request->session();
        $total_cart = 0;
        $total_item = 0;
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                foreach ($session->get('shopping_cart') as  $cart) {
                    $total_cart += $cart['product_price'] * $cart['product_quantity'];
                    $total_item++;
                }
            }
        }

        $data = [
            'carts' => session('shopping_cart'),
            'total_cart' => $total_cart,
            'total_item' => $total_item,
        ];

        return view('home.ajax.ajax_cart', $data);
    }

    public function viewCartPay (Request $request) {
        $config = DB::table('configs')->find(1);

        $session = $request->session();
        $total_price = 0;
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                foreach ($session->get('shopping_cart') as  $cart) {
                    $total_price += $cart['product_price'] * $cart['product_quantity'];
                }
            }
        }

        $carts = [];
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                $carts = session('shopping_cart');
            }
        }
        
        $data = [
            'head_title' => 'Thanh toán',
            'breadcrumb_title' => 'Thanh toán',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,

            'carts' => $carts,
            'total_price' => $total_price,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.cartPay', $data);
    }

    public function addCartAdmin (Request $request) {
        $add = 1;
        $session = $request->session();
        $total_price = 0;
        $total_item = 0;
        if ($session->has('shopping_cart')) {
            if (!empty($session->get('shopping_cart'))) {
                foreach ($session->get('shopping_cart') as  $cart) {
                    $total_price += $cart['product_price'] * $cart['product_quantity'];
                    $total_item++;
                }
            } else {
                // cart rỗng.
                $add = 0;
            }
        } else {
            // không có cart.
            $add = 0;
        }

        // lưu vào admin
        if ($add == 1) {
            $add_cart = [
                'name' => $request->input('txtName'),
                'email' => $request->input('txtEmail'),
                'phone' => $request->input('txtPhone'),
                'address' => $request->input('txtAddress'),
                'note' => $request->input('txtNote'),

                'state' => 1,
                'creator_id' => 0,
                'total_price' => $total_price,
                'total_item' => $total_item,
            ];
            $cart_main = Cart::create($add_cart);

            foreach ($session->get('shopping_cart') as  $cart) {
                $total_price = $cart['product_price'] * $cart['product_quantity'];

                $add_cart_item = [
                    'cart_id' => $cart_main['id'],
                    'product_id' => $cart['product_id'],
                    'product_price' => $cart['product_price'],
                    'product_quantity' => $cart['product_quantity'],
                    'product_price_total' => $total_price,
                    'size' => $cart['product_size'],
                ];

                $cart_item = CartItem::create($add_cart_item);
            }

            $request->session()->forget('shopping_cart');
            $total_price = 0;

            CartProcessed::dispatch($cart_main);

            $errors = ['Bạn đặt hàng thành công'];
        } else {
            $errors = ['Giỏ hàng để trống'];
        }
        
        return redirect('thanh-toan')
                        ->withErrors($errors);
    }

    public function postAll () {
        $config = DB::table('configs')->find(1);
        
        $newsCats = DB::table('news_cats')->orderBy('id')->get();
        $post_new =DB::table('posts')->orderByDesc('id')->take(4)->get();
        $postModel = DB::table('posts')->orderByDesc('id');
        
        $data = [
            'head_title' => 'Tất cả tin tức',
            'breadcrumb_title' => 'Tất cả tin tức',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'posts' => $postModel->paginate(4),

            'sidebar_newscats' => $newsCats,
            'sidebar_post_new' => $post_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.posts', $data);
    }

    public function newsCat ($slug) {
        $newsCat = DB::table('news_cats')->where('slug', $slug)->first();
        if (empty($newsCat)) {
            return redirect()->to('/');
        }
        
        $newsCats = DB::table('news_cats')->orderBy('id')->get();
        $post_new = DB::table('posts')->orderByDesc('id')->take(4)->get();

        $match = '%"'.$newsCat->id.'"%';
        $postModel = DB::table('posts')->where('newscat_id', 'like', $match)->orderByDesc('id');
        
        $data = [
            'head_title' => $newsCat->title_seo,
            'breadcrumb_title' => $newsCat->title,
            'head_des' => $newsCat->description,
            'head_keyword' => $newsCat->keyword,
            'og_image' => '/storage/uploads/newscat/'.$newsCat->image,
            
            'posts' => $postModel->paginate(4),

            'sidebar_newscats' => $newsCats,
            'sidebar_post_new' => $post_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.posts', $data);
    }

    public function searchPost (Request $request) {
        $config = DB::table('configs')->find(1);
        
        $newsCats = DB::table('news_cats')->orderBy('id')->get();
        $post_new = DB::table('posts')->orderByDesc('id')->take(4)->get();

        $q = $request->query('q');
        $q = str_replace(" ", "-", $q);
        $q = str_replace("+", "-", $q);
        $q = urldecode($q);
        $q = Str::slug($q);
        $q_arr = explode("-", $q);

        $postModel = DB::table('posts');
        foreach ($q_arr as $slug) {
            $match = '%'.$slug.'%';
            $postModel = $postModel->where('slug', 'like', $match);
        }
        $postModel = $postModel->orderByDesc('id');
        
        $data = [
            'head_title' => 'Tìm kiếm tin tức',
            'breadcrumb_title' => 'Tìm kiếm tin tức',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,
            
            'posts' => $postModel->paginate(4)->appends(['q' => $q]),

            'sidebar_newscats' => $newsCats,
            'sidebar_post_new' => $post_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.posts', $data);
    }

    public function post ($slug) {
        $post = DB::table('posts')->where('slug', $slug)->first();//dd($post);
        if (empty($post)) {
            return redirect()->to('/');
        }

        $newsCats = DB::table('news_cats')->orderBy('id')->get();
        $post_new = DB::table('posts')->orderByDesc('id')->take(4)->get();

        if (empty($post->newscat_id)) {
            $post_relate = DB::table('posts')->orderByDesc('id')->take(4)->get();
        } else {
            $newscat_id = json_decode($post->newscat_id, true);
            if (empty($newscat_id)) {
                $post_relate = DB::table('posts')->orderByDesc('id')->take(4)->get();
            } else {
                $newscat_id_one = $newscat_id[0];
                $match = '%"'.$newscat_id_one.'"%';
                $post_relate = DB::table('posts')->where('newscat_id', 'like', $match)->orderByDesc('id')->take(4)->get();
            }
        }
        
        $data = [
            'head_title' => $post->title_seo,
            'breadcrumb_title' => $post->title,
            'head_des' => $post->des_seo,
            'head_keyword' => $post->keyword,
            'og_image' => '/storage/uploads/post/'.$post->image,

            'post' => $post,
            'post_relate' => $post_relate,

            'sidebar_newscats' => $newsCats,
            'sidebar_post_new' => $post_new,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.post', $data);
    }

    public function contact () {
        $config = DB::table('configs')->find(1);
                
        $data = [
            'head_title' => 'Liên hệ',
            'breadcrumb_title' => 'Liên hệ',
            'head_des' => $config->description,
            'head_keyword' => $config->keyword,
            'og_image' => '/storage/uploads/config/'.$config->logo,

            'web_name' => $config->title,
            'web_address' => $config->content_home_1,
            'web_phone' => $config->content_home_7,
            'web_email' => $config->content_home_4,
        ];

        $data_more = $this->get_info_main();
        $data = array_merge($data, $data_more);

        return view('home.page.contact', $data);
    }

    public function contactAdd (Request $request) {
        $add = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'note' => $request->input('note'),
        ];
        $contact = Contact::create($add);
        
        $errors = ['Bạn đã gửi liên hệ thành công'];
        return redirect('lien-he')
                        ->withErrors($errors);
    }
}
