<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pages' => Page::simplePaginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/page/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/page/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
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


            $path = 'public/uploads/page/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/page', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_add('pages', $slug);

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
        ];
        $page = Page::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/pages/'.$page['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return redirect('admin/pages/'.$page['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data = [
            'page' => $page,
            // 'checkbox_state' => $page['state']==1 ? '1' : '0',
        ];
        $data['menu_active'] = Together::check_url_menu();

        // dd($_SESSION['user']['id']);
        return view('admin/page/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
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


            $path = 'public/uploads/page/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/page', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_edit('pages', $slug, $page->id);

        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->title_seo = $request->input('title_seo');
        $page->des_seo = $request->input('des_seo');
        $page->keyword = $request->input('keyword');
        $page->state = $state;
        $page->slug = $slug;
        if (isset($validated['image'])) {
            $page->image = $img_name_new;
        }
        $page->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/pages/'.$page->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect('admin/pages');
    }
}
