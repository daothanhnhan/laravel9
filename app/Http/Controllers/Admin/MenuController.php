<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\MenuType;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public $output_edit;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'menus' => Menu::simplePaginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();
        // dd($data);

        return view('admin/menu/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'menu_types' => MenuType::get(),
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/menu/new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }

        $data = [
            'parent_id' => $request->input('parent_id'),
            'name' => $request->input('name'),

            'type' => $request->input('type'),
            'type_id' => (int)$request->input('type_id'),

            'link' => $request->input('link'),
            'state' => $state,
            'sort' => $request->input('sort'),
        ];
        $menu = Menu::create($data);//dd($page);

        $errors = ['Tạo mới thành công'];
        // $request->session()->flash('errors', $errors);
        return redirect('admin/menus/'.$menu['id'].'/edit')
                        ->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return redirect('admin/menus/'.$menu['id'].'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        // $data = [
        //     'menu' => $menu,
        //     'menu_types' => MenuType::get(),
        // ];
        $data = $this->get_menu_id($menu->id);
        $data['menu_active'] = Together::check_url_menu();

        return view('admin/menu/edit', $data);
    }

    public function get_menu_id ($id) {
        $menu = Menu::find($id);//dd($menu->name);

        $menu_types = MenuType::get();

        $output_select = $this->getSelectType_edit($menu->type, $menu->type_id, $menu->link);

        $data = [
            'menu' => $menu,
            'menu_types' => $menu_types,
            'output_select' => $output_select,
        ];
        $data['menu_active'] = Together::check_url_menu();

        return $data;
    }

    public function getSelectType_edit ($type, $id, $link) {
        if ($type == 0) {
            $output = '<label for="">Link</label>
                    <input type="text" name="link" value="'.$link.'" class="form-control">';
        } else {
            $menu_type = MenuType::where('type', $type)->first()->toArray();
            // $menu_type = (array)$menu_type;
            // dd($menu_type);

            // kiểm tra xem có phải là table danh mục hay không
            $types_has = DB::table($type)->first();
            $types = DB::table($type)->get();
            $parent_id_is = 0;
            if ($types_has !== null) {
                $types[0] = (array)$types[0];
                if (array_key_exists('parent_id', $types[0])) {
                    $types = DB::table($type)->where('parent_id', 0)->get();
                    $parent_id_is = 1;
                }
            }
            // dd($types);

            $output = '<label for="">'.$menu_type['name'].'</label>';
            $output .= '<select name="type_id" class="form-control">';
            foreach ($types as $item) {
                $item = (array)$item;
                if ($item['state'] == 0 && $type == 'menu_specials') {
                    continue;
                }
                
                if (array_key_exists('title', $item)) {
                    $title = $item['title'];
                } else {
                    $title = $item['name'];
                }

                $selected = '';
                if ($item['id'] == $id) {
                    $selected = 'selected';
                }

                $output .= '<option value="'.$item['id'].'" '.$selected.' >'.$title.'</option>';
                if ($parent_id_is == 1) {
                    $this->output_edit = '';
                    $output .= $this->model_has_parent($type, $item['id'], 0, $id);
                }
                
            }
            $output .= '</select>';
        }

        // $output = '<p>tuan</p>';

        return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $state = 0;
        if ($request->input('state') !== null) {
            $state = $request->input('state');
        }


        $menu->parent_id = $request->input('parent_id');
        $menu->name = $request->input('name');

        $menu->type = $request->input('type');
        $menu->type_id = (int)$request->input('type_id');

        $menu->link = $request->input('link');
        $menu->state = $state;
        $menu->sort = $request->input('sort');

        $menu->save();

        $errors = ['Cập nhật thành công'];
        return redirect('admin/menus/'.$menu->id.'/edit')
                        ->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $child = Menu::where('parent_id', $menu->id)->first();
        if ($child === null) {
            $menu->delete();
            return redirect('admin/menus');
        } else {
            $errors = ['Bạn phải xóa menu con trước'];
            return redirect('admin/menus')->withErrors($errors);;
        }
    }

    public function getSelectType($type)
    {
        if ($type == 0) {
            $output = '<label for="">Link</label>
                    <input type="text" name="link" value="" class="form-control">';
        } else {
            $table = $type;
            $menu_type = DB::table('menu_types')->where('type', $table)->first();
            
            // kiểm tra table có cột parent_id hay không.
            // nếu có thì table thộc loại danh mục.
            // lấy ra các record cấp 0
            $types_has = DB::table($table)->first();//dd($types_has);
            $types = DB::table($table)->get();
            // $arr = (array)$types[0];dd($arr);// convert từ stdClass sang mảng nhé.
            $parent_id_is = 0;
            if ($types_has !== null) {
                if (isset($types[0]->parent_id)) {
                    $types = DB::table($table)->where('parent_id', 0)->get();
                    $parent_id_is = 1;
                }
            }
            // dd($types);

            // state=0 thì bỏ qua
            // nếu là danh mục thì hiện thị dạng cấp.
            $output = '<label for="">'.$menu_type->name.'</label>';
            $output .= '<select name="type_id" class="form-control">';
            foreach ($types as $item) {
                if ($item->state == 0) {
                    continue;
                }
                
                if (isset($item->title)) {
                    $title = $item->title;
                } else {
                    $title = $item->name;
                }

                $output .= '<option value="'.$item->id.'">'.$title.'</option>';
                if ($parent_id_is == 1) {
                    $this->output_edit = '';
                    $output .= $this->model_has_parent($table, $item->id, 0, 0);
                }
                
            }
            $output .= '</select>';
        }

        // $output = '<p>tuan</p>';

        return $output;
    }

    public function model_has_parent ($model, $parent_id, $level, $id) {
        $level++;
        $tab = '';
        for ($i=0; $i<$level; $i++) {
            $tab .= '|--';
        }
        // $row = [];
        $models = DB::table($model)->where('parent_id', $parent_id)->get();
        foreach ($models as $item) {
            if ($item->state == 0 && $model == 'menu_specials') {
                    continue;
            }
            
            if (isset($item->title)) {
                $title = $item->title;
            } else {
                $title = $item->name;
            }

            $selected = '';
            if ($item->id == $id) {
                $selected = 'selected';
            }
            $this->output_edit .= '<option value="'.$item->id.'" '.$selected.' >'.$tab.$title.'</option>';
            $this->model_has_parent_child($model, $item->id, $level, $id);
        }

        return $this->output_edit;
    }

    public function model_has_parent_child ($model, $parent_id, $level, $id) {
        $level++;
        $tab = '';
        for ($i=0; $i<$level; $i++) {
            $tab .= '|--';
        }
        // $row = [];
        $models = DB::table($model)->where('parent_id', $parent_id)->get();//dd($models);
        foreach ($models as $item) {
            $item = (array)$item;
            // $item = $item->toArray();
            if ($item['state'] == 0 && $model == 'menu_specials') {
                    continue;
            }
            
            if (array_key_exists('title', $item)) {
                $title = $item['title'];
            } else {
                $title = $item['name'];
            }

            $selected = '';
            if ($item['id'] == $id) {
                $selected = 'selected';
            }
            $this->output_edit .= '<option value="'.$item['id'].'" '.$selected.' >'.$tab.$title.'</option>';
            $this->model_has_parent_child($model, $item['id'], $level, $id);
        }

        // return $this->output_edit;
    }

    public function sort()
    {
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/menu/list_sort', $data);
    }

    public function sortAjax (Request $request) {
        $input = $request->all();
        $arr_1 = json_decode($input['name'], true);//return $arr_1;
        $count = count($arr_1);
        $d = 0;
        foreach ($arr_1 as $item) {
            $d++;
            
            $menu = Menu::find($item['id']);
            $menu->sort = $d;
            $menu->parent_id = 0;
            $menu->save();

            if (array_key_exists('children', $item)) {
                if (!empty($item['children'])) {
                    $this->sortAjax_child($item['children'], $item['id']);
                }
            }

        }
     
        return response()->json(['success'=>$input['name']]);
        // return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    public function sortAjax_child ($arr, $parent_id) {
        $k = 0;
        foreach ($arr as $child) {
            $k++;

            $menu = Menu::find($child['id']);
            $menu->sort = $k;
            $menu->parent_id = $parent_id;
            $menu->save();

            if (array_key_exists('children', $child)) {
                if (!empty($child['children'])) {
                    $this->sortAjax_child($child['children'], $child['id']);
                }
            }
        }
    }
}
