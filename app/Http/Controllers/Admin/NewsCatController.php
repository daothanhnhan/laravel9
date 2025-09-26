<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCat;
use App\Http\Requests\StoreNewsCatRequest;
use App\Http\Requests\UpdateNewsCatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'newscats' => NewsCat::simplePaginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/newsCat/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/newsCat/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsCatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsCatRequest $request)
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


            $path = 'public/uploads/newscat/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/newscat', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_add('news_cats', $slug);

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
        $newscat = NewsCat::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/newscats/'.$newscat['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsCat  $newsCat
     * @return \Illuminate\Http\Response
     */
    public function show(NewsCat $newscat)
    {
        // NewsCat $newsCat bị lỗi
        // dd($newscat['title']);
        return redirect('admin/newscats/'.$newscat['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsCat  $newsCat
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsCat $newscat)
    {
        // dd($newsCat['title']);
        // dd($newsCat);
        $data = [
            'newsCat' => $newscat,
        ];
        $data['menu_active'] = Together::check_url_menu();

        
        return view('admin/newsCat/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsCatRequest  $request
     * @param  \App\Models\NewsCat  $newsCat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsCatRequest $request, NewsCat $newscat)
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


            $path = 'public/uploads/newscat/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/newscat', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_edit('news_cats', $slug, $newscat->id);

        $newscat->title = $request->input('title');
        $newscat->description = $request->input('description');
        $newscat->content = $request->input('content');
        $newscat->title_seo = $request->input('title_seo');
        $newscat->des_seo = $request->input('des_seo');
        $newscat->keyword = $request->input('keyword');
        $newscat->state = $state;
        $newscat->slug = $slug;
        $newscat->sort = $request->input('sort');
        $newscat->parent_id = $request->input('parent_id');
        if (isset($validated['image'])) {
            $newscat->image = $img_name_new;
        }
        $newscat->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/newscats/'.$newscat->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsCat  $newsCat
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsCat $newscat)
    {
        $newscat->delete();
        return redirect('admin/newscats');
    }
}
