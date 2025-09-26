<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Tuan;
// use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\NewsCatController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCatController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CartItemController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/test', function () {
	// echo now();
    // return view('welcome');
    // dd(session('shopping_cart'));
    // session();
    // dd($_SESSION['shopping_cart']);
// });
// Route::get('/tuan', [Tuan::class, 'session_test']);
Route::get('/logout', [Tuan::class, 'logout']);
Route::get('/admin/logout', [Tuan::class, 'logout']);


// Route::get('admin/create', [PostController::class, 'showform']);
// Route::post('admin/create', [PostController::class, 'validationform']);
// Route::get('/admin/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
// Route::post('/admin/news/store', [AdminNewsController::class, 'store']);
// Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news');;
// Route::get('/admin/news/{id}', [AdminNewsController::class, 'show']);
// Route::get('/admin/news/edit/{id}', [AdminNewsController::class, 'edit']);
// Route::patch('/admin/news/update/{id}', [AdminNewsController::class, 'update']);
// Route::delete('/admin/news/delete/{id}', [AdminNewsController::class, 'destroy']);
// Route::get('/ajax', [Tuan::class, 'ajax']);
// Route::get('/lang', [Tuan::class, 'lang1']);
// Route::get('/text-1', [Tuan::class, 'tuan_text']);
// Route::get('ajaxRequest', [Tuan::class, 'ajaxRequest']);
// Route::post('ajaxRequest', [Tuan::class, 'ajaxRequestPost'])->name('ajaxRequest.post');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'index']);
Route::get('/page/{slug}', [HomeController::class, 'page']);
Route::get('/danh-muc-san-pham/{slug}', [HomeController::class, 'productCat']);
Route::get('/san-pham/{slug}', [HomeController::class, 'product']);
Route::get('/danh-muc-tin-tuc/{slug}', [HomeController::class, 'newsCat']);
Route::get('/tin-tuc/{slug}', [HomeController::class, 'post']);

Route::get('/tat-ca-tin-tuc', [HomeController::class, 'postAll']);
Route::get('/tat-ca-san-pham', [HomeController::class, 'productAll']);
Route::get('/sale', [HomeController::class, 'productSale']);
Route::get('/filter', [HomeController::class, 'filter']);
Route::get('/filter-price', [HomeController::class, 'filterPrice']);
Route::get('/tim-kiem-san-pham', [HomeController::class, 'searchProduct']);
Route::get('/tim-kiem-tin-tuc', [HomeController::class, 'searchPost']);
Route::get('/tim-kiem-tin-tuc', [HomeController::class, 'searchPost']);
Route::get('/lien-he', [HomeController::class, 'contact']);
Route::post('/lien-he', [HomeController::class, 'contactAdd']);
Route::get('/gio-hang', [HomeController::class, 'viewCart']);
Route::get('/thanh-toan', [HomeController::class, 'viewCartPay']);
Route::post('/thanh-toan', [HomeController::class, 'addCartAdmin']);
// ajax
Route::post('/add-cart', [HomeController::class, 'addCartHome']);
Route::get('/cart-change-quantity', [HomeController::class, 'cartChangeQuantity']);
Route::get('/del-item-cart', [HomeController::class, 'cartDelItem']);

Route::prefix('admin')->group(function () {
    Route::middleware('auth')->group(function () {
	    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	    Route::get('/dashboard', [ConfigController::class, 'dashBoard'])->name('dashboard');

	    // Route::get('/users', [UserController::class, 'index']);
	    Route::resource('users', UserController::class);

	    Route::resource('slides', SlideController::class);
	    Route::get('/slide-sort', [SlideController::class, 'sort']);

	    Route::resource('pages', PageController::class);

	    Route::resource('newscats', NewsCatController::class);

	    Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');
	    Route::resource('posts', PostController::class);
	    // phải để posts/search bên trên, để dưới là bị 404

	    Route::resource('productcats', ProductCatController::class);

	    Route::post('products/copy/{product}', [ProductController::class, 'copy'])->name('products.copy');
	    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
	    Route::resource('products', ProductController::class);

	    Route::resource('videos', VideoController::class);

	    Route::get('menus/get-select-type/{type}', [MenuController::class, 'getSelectType'])->name('menus.select');
	    Route::get('menus/sort', [MenuController::class, 'sort'])->name('menus.sort');
	    Route::post('menus/sort-ajax', [MenuController::class, 'sortAjax'])->name('menus.sortAjax');
	    Route::resource('menus', MenuController::class);

	    Route::get('config', [ConfigController::class, 'index'])->name('config.index');
	    Route::patch('config', [ConfigController::class, 'update'])->name('config.update');

	    Route::resource('contacts', ContactController::class);

	    Route::get('carts/search', [CartController::class, 'search'])->name('carts.search');
	    Route::resource('carts', CartController::class);

	    Route::get('cart-item/edit/{id}', [CartItemController::class, 'edit']);
	    Route::get('cart-item/edit-total/{id}', [CartItemController::class, 'editTotal']);
	});
});

require __DIR__.'/auth.php';
