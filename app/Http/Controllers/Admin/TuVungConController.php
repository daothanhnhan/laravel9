<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TuVungCon;
use App\Http\Requests\StoreTuVungConRequest;
use App\Http\Requests\UpdateTuVungConRequest;
use Illuminate\Http\Request;

class TuVungConController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tuvungcons' => TuVungCon::Paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/tuVungCon/list', $data);
    }

     public function index_state()
    {
        $data = [
            'tuvungcons' => TuVungCon::where('state', 1)->Paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/tuVungCon/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/tuVungCon/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTuVungConRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTuVungConRequest $request)
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
        $tuvungcon = TuVungCon::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        return redirect('admin/tuvungcons/'.$tuvungcon->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuVungCon  $tuVungCon
     * @return \Illuminate\Http\Response
     */
    public function show(TuVungCon $tuvungcon)
    {
        return redirect('admin/tuvungcons/'.$tuvungcon->id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuVungCon  $tuVungCon
     * @return \Illuminate\Http\Response
     */
    public function edit(TuVungCon $tuvungcon)
    {
        $data = [
            'tuvungcon' => $tuvungcon,
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/tuVungCon/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTuVungConRequest  $request
     * @param  \App\Models\TuVungCon  $tuVungCon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTuVungConRequest $request, TuVungCon $tuvungcon)
    {
        $validated = $request->validated();

        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }
        $tuvungcon->state = $state;
        $tuvungcon->name = $request->input('name');
        $tuvungcon->content = $request->input('content');
        $tuvungcon->note = $request->input('note');
        $tuvungcon->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/tuvungcons/'.$tuvungcon->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuVungCon  $tuVungCon
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuVungCon $tuvungcon)
    {
        $tuvungcon->delete();
        return redirect('admin/tuvungcons');
    }

    public function change_state(Request $request)
    {
        $id = $request->input('id');
        $tuvungcon = TuVungCon::find($id);

        if ($tuvungcon->state == 0) {
            $tuvungcon->state = 1;
        } else {
            $tuvungcon->state = 0;
        }
        $tuvungcon->save();
    }
}
