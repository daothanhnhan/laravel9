<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'products' => Product::paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/product/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/product/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();//dd($validated);

        if (isset($validated['image'])) {
            $file = $validated['image'];

            $extension = $file->extension();
            $img_name = $file->getClientOriginalName();
            $img_name = collect($img_name)->remove_extension_file()[0];
            $img_name = Str::of($img_name)->slug('-');
            $img_name_new = $img_name.'.'.$extension;
            // dd($file->getClientOriginalName());


            $path = 'public/uploads/product/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/product', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        // chỉ lấy được dấy '+', dấy '#' là null, không dấu cũng null
        // dd($request);
        // dd($request->files);
        // dd($request->files->parameters);
        // dd($request->convertedFiles);
        // dd($request->method);
        $files = $request->file('image_sub');
        // dd($files);
        $image_sub = [];
        if ($files !== null) {
            foreach ($files as $file_item) {
                $img_sub = Together::image_name($file_item);
                // dd($img_sub);
                $path = 'public/uploads/product/' . $img_sub;
                if (Storage::get($path)) {
                    // echo 'đã có';
                } else {
                    // echo 'không có';
                    $path = $file_item->storeAs('public/uploads/product', $img_sub);
                }

                $image_sub[] = $img_sub;
            }
        }
        $image_sub = json_encode($image_sub);

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $product_new = 0;
        if ($request->input('product_new') !== null) {
            $product_new = $request->input('product_new');
        }

        $product_hot = 0;
        if ($request->input('product_hot') !== null) {
            $product_hot = $request->input('product_hot');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_add('products', $slug);

        $productcat_id = json_encode($request->input('productcat_id'));
        if ($request->input('productcat_id') === null) {
            $productcat_id = json_encode(array());
        }

        $price = str_replace(",", "", $request->input('price'));
        $price_sale = str_replace(",", "", $request->input('price_sale'));

        $data = [
            'title' => $validated['title'],
            'image' => $img_name_new,
            'image_sub' => $image_sub,
            'description' => $request->input('description'),
            'content' => $request->input('content'),

            'price' => $price,
            'price_sale' => $price_sale,
            'product_code' => $request->input('product_code'),
            'product_shape' => $request->input('product_shape'),
            'product_size' => $request->input('product_size'),
            'product_brand' => $request->input('product_brand'),
            'product_origin' => $request->input('product_origin'),
            'product_text_1' => $request->input('product_text_1'),

            'title_seo' => $request->input('title_seo'),
            'des_seo' => $request->input('des_seo'),
            'keyword' => $request->input('keyword'),

            'state' => $state,
            'product_new' => $product_new,
            'product_hot' => $product_hot,
            'slug' => $slug,
            'creator_id' => Auth::id(),
            // 'sort' => $request->input('sort'),
            'productcat_id' => $productcat_id,
        ];
        $product = Product::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/products/'.$product['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return redirect('admin/products/'.$product['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = [
            'product' => $product,
            'image_sub' => json_decode($product['image_sub']),
        ];
        $data['menu_active'] = Together::check_url_menu();

        return view('admin/product/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        // dd($validated);

        if (isset($validated['image'])) {
            $file = $validated['image'];

            $extension = $file->extension();
            $img_name = $file->getClientOriginalName();
            $img_name = collect($img_name)->remove_extension_file()[0];
            $img_name = Str::of($img_name)->slug('-');
            $img_name_new = $img_name.'.'.$extension;
            // dd($file->getClientOriginalName());


            $path = 'public/uploads/product/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/product', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $image_sub = [];
        if ($request->input('image_sub_old') !== null) {
            $image_sub = $request->input('image_sub_old');
        }

        $files = $request->file('image_sub');
        // dd($files);
        // $image_sub = [];
        if ($files !== null) {
            foreach ($files as $file_item) {
                $img_sub = Together::image_name($file_item);
                // dd($img_sub);
                $path = 'public/uploads/product/' . $img_sub;
                if (Storage::get($path)) {
                    // echo 'đã có';
                } else {
                    // echo 'không có';
                    $path = $file_item->storeAs('public/uploads/product', $img_sub);
                }

                $image_sub[] = $img_sub;
            }
        }
        $image_sub = json_encode($image_sub);

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $product_new = 0;
        if ($request->input('product_new') !== null) {
            $product_new = $request->input('product_new');
        }

        $product_hot = 0;
        if ($request->input('product_hot') !== null) {
            $product_hot = $request->input('product_hot');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_edit('products', $slug, $product->id);

        $productcat_id = json_encode($request->input('productcat_id'));
        if ($request->input('productcat_id') === null) {
            $productcat_id = json_encode(array());
        } 

        $price = str_replace(",", "", $request->input('price'));
        $price_sale = str_replace(",", "", $request->input('price_sale'));
        

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->content = $request->input('content');

        $product->price = $price;
        $product->price_sale = $price_sale;
        $product->product_code = $request->input('product_code');
        $product->product_shape = $request->input('product_shape');
        $product->product_size = $request->input('product_size');
        $product->product_brand = $request->input('product_brand');
        $product->product_origin = $request->input('product_origin');
        $product->product_text_1 = $request->input('product_text_1');

        $product->title_seo = $request->input('title_seo');
        $product->des_seo = $request->input('des_seo');
        $product->keyword = $request->input('keyword');

        $product->state = $state;
        $product->product_new = $product_new;
        $product->product_hot = $product_hot;
        $product->slug = $slug;
        // $post->sort = $request->input('sort');
        $product->productcat_id = $productcat_id;
        if (isset($validated['image'])) {
            $product->image = $img_name_new;
        }
        $product->image_sub = $image_sub;
        $product->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/products/'.$product->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products');
    }

    public function copy(Product $product)
    {
        $data = [
            'title' => $product->title,
            'image' => $product->image,
            'image_sub' => $product->image_sub,
            'description' => $product->description,
            'content' => $product->content,

            'price' => $product->price,
            'price_sale' => $product->price_sale,
            'product_code' => $product->product_code,
            'product_shape' => $product->product_shape,
            'product_size' => $product->product_size,
            'product_brand' => $product->product_brand,
            'product_origin' => $product->product_origin,
            'product_text_1' => $product->product_text_1,

            'title_seo' => $product->title_seo,
            'des_seo' => $product->des_seo,
            'keyword' => $product->keyword,

            'state' => $product->state,
            'product_new' => $product->product_new,
            'product_hot' => $product->product_hot,
            'slug' => Together::slug_add('products', $product->slug),
            'creator_id' => Auth::id(),
            // 'sort' => $request->input('sort'),
            'productcat_id' => $product->productcat_id,
        ];
        $product = Product::create($data);//dd($page);

        $errors = ['Nhân bản thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/products/'.$product['id'].'/edit')
                        ->withErrors($errors);
    }

    public function search (Request $request) {
        $q = $request->query('q');
        $q = str_replace(" ", "-", $q);
        $q = str_replace("+", "-", $q);
        $q = urldecode($q);
        $q = Str::slug($q);
        $q_arr = explode("-", $q);
        // dd($q_arr);

        $like = '%'.$q_arr[0].'%';
        $productModel = Product::where('slug', 'like', $like);
        unset($q_arr[0]);
        foreach ($q_arr as $item) {
            $like = '%'.$item.'%';
            $productModel->where('slug', 'like', $like);
        }
        // dd($like);
        $productModel->orderBy('id');
        // $postModel->orderBy('id')->dump();
        $data = [
            'products' => $productModel->paginate(20)->appends(['q' => $q]),
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/product/list', $data);
    }
}
