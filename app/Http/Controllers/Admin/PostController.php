<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/post/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/post/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
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


            $path = 'public/uploads/post/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/post', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_add('posts', $slug);

        $newscat_id = json_encode($request->input('newscat_id'));
        if ($request->input('newscat_id') === null) {
            $newscat_id = json_encode(array());
        }

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
            // 'sort' => $request->input('sort'),
            'newscat_id' => $newscat_id,
        ];
        $post = Post::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/posts/'.$post['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect('admin/posts/'.$post['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
        ];
        $data['menu_active'] = Together::check_url_menu();

        return view('admin/post/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
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


            $path = 'public/uploads/post/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/post', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $slug = Str::slug($validated['title']);
        $slug = Together::slug_edit('posts', $slug, $post->id);

        $newscat_id = json_encode($request->input('newscat_id'));
        if ($request->input('newscat_id') === null) {
            $newscat_id = json_encode(array());
        } 
        

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->title_seo = $request->input('title_seo');
        $post->des_seo = $request->input('des_seo');
        $post->keyword = $request->input('keyword');
        $post->state = $state;
        $post->slug = $slug;
        // $post->sort = $request->input('sort');
        $post->newscat_id = $newscat_id;
        if (isset($validated['image'])) {
            $post->image = $img_name_new;
        }
        $post->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/posts/'.$post->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('admin/posts');
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
        $postModel = Post::where('slug', 'like', $like);
        unset($q_arr[0]);
        foreach ($q_arr as $item) {
            $like = '%'.$item.'%';
            $postModel = $postModel->where('slug', 'like', $like);
        }
        // dd($like);
        $postModel = $postModel->orderBy('id');
        // $postModel->orderBy('id')->dump();
        $data = [
            'posts' => $postModel->paginate(20)->appends(['q' => $q]),
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/post/list', $data);
    }
}
