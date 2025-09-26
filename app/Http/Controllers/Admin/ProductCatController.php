<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCat;
use App\Http\Requests\StoreProductCatRequest;
use App\Http\Requests\UpdateProductCatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'productcats' => ProductCat::simplePaginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/productCat/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/productCat/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductCatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCatRequest $request)
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


            $path = 'public/uploads/productcat/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/productcat', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_add('product_cats', $slug);

        $data = [
            'title' => $validated['title'],
            'image' => $img_name_new,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'title_seo' => $request->input('title_seo'),
            'des_seo' => $request->input('des_seo'),
            'keyword' => $request->input('keyword'),
            'state' => $state,
            'slug' => $slug,
            'creator_id' => Auth::id(),
            'sort' => $request->input('sort'),
            'parent_id' => $request->input('parent_id'),
        ];
        $productcat = ProductCat::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/productcats/'.$productcat['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCat $productcat)
    {
        return redirect('admin/productcats/'.$productcat['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCat $productcat)
    {
        $data = [
            'productCat' => $productcat,
        ];
        $data['menu_active'] = Together::check_url_menu();
        
        return view('admin/productCat/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCatRequest  $request
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCatRequest $request, ProductCat $productcat)
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


            $path = 'public/uploads/productcat/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/productcat', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_edit('product_cats', $slug, $productcat->id);

        $productcat->title = $request->input('title');
        $productcat->description = $request->input('description');
        $productcat->content = $request->input('content');
        $productcat->title_seo = $request->input('title_seo');
        $productcat->des_seo = $request->input('des_seo');
        $productcat->keyword = $request->input('keyword');
        $productcat->state = $state;
        $productcat->slug = $slug;
        $productcat->sort = $request->input('sort');
        $productcat->parent_id = $request->input('parent_id');
        if (isset($validated['image'])) {
            $productcat->image = $img_name_new;
        }
        $productcat->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/productcats/'.$productcat->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCat $productcat)
    {
        $productcat->delete();
        return redirect('admin/productcats');
    }
}
