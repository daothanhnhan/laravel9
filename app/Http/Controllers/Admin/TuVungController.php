<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TuVung;
use App\Http\Requests\StoreTuVungRequest;
use App\Http\Requests\UpdateTuVungRequest;
use Illuminate\Http\Request;

class TuVungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tuvungs' => TuVung::Paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/tuVung/list', $data);
    }

    public function index_state()
    {
        $data = [
            'tuvungs' => TuVung::where('state', 1)->Paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/tuVung/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/tuVung/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTuVungRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTuVungRequest $request)
    {
        $validated = $request->validated();//dd($validated);

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $data = [
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'note' => $request->input('note'),
            'state' => $state,
        ];
        $tuvung = TuVung::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        return redirect('admin/tuvungs/'.$tuvung->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuVung  $tuVung
     * @return \Illuminate\Http\Response
     */
    public function show(TuVung $tuvung)
    {
        return redirect('admin/tuvungs/'.$tuvung->id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuVung  $tuVung
     * @return \Illuminate\Http\Response
     */
    public function edit(TuVung $tuvung)
    {
        $data = [
            'tuvung' => $tuvung,
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/tuVung/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTuVungRequest  $request
     * @param  \App\Models\TuVung  $tuVung
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTuVungRequest $request, TuVung $tuvung)
    {
        $validated = $request->validated();

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }
        $tuvung->state = $state;
        $tuvung->name = $request->input('name');
        $tuvung->content = $request->input('content');
        $tuvung->note = $request->input('note');
        $tuvung->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/tuvungs/'.$tuvung->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuVung  $tuVung
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuVung $tuvung)
    {
        $tuvung->delete();
        return redirect('admin/tuvungs');
    }

    public function change_state(Request $request)
    {
        $id = $request->input('id');
        $tuvung = TuVung::find($id);

        if ($tuvung->state == 0) {
            $tuvung->state = 1;
        } else {
            $tuvung->state = 0;
        }
        $tuvung->save();
    }
}
