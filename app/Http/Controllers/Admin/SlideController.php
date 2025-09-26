<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'slides' => Slide::paginate(1000),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/slide/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/slide/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSlideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['image'];
        // $sort = $request->input('sort');

        $extension = $file->extension();
        $img_name = $file->getClientOriginalName();
        $img_name = collect($img_name)->remove_extension_file()[0];
        $img_name = Str::of($img_name)->slug('-');
        $img_name_new = $img_name.'.'.$extension;
        // dd($file->getClientOriginalName());


        $path = 'public/uploads/slide/' . $img_name_new;
        if (Storage::get($path)) {
            // echo 'đã có';
        } else {
            // echo 'không có';
            $path = $file->storeAs('public/uploads/slide', $img_name_new);
        }


        $data = [
            'image' => $img_name_new,
            'sort' => $request->input('sort'),
        ];
        $slide = Slide::create($data);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/slides')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        return redirect('admin/slides/'.$slide['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        $data = [
            'slide' => $slide
        ];
        $data['menu_active'] = Together::check_url_menu();

        // dd($_SESSION['user']['id']);
        return view('admin/slide/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
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


            $path = 'public/uploads/slide/' . $img_name_new;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $file->storeAs('public/uploads/slide', $img_name_new);
            }
        } else {
            $img_name_new = '';
        }

        $slide->sort = $request->input('sort');
        if (isset($validated['image'])) {
            $slide->image = $img_name_new;
        }
        $slide->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/slides/'.$slide->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect('admin/slides');
    }

    public function sort (Request $request) {
        $id = $request->input('id');
        $sort = $request->input('sort');

        $slide = Slide::find($id);
        $slide->sort = $sort;
        $slide->save();

        return json_encode(['thành công']);
    }
}
