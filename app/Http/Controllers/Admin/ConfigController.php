<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Together;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateConfigRequest;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::find(1);
        $data = [
            'config' => $config,
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/config/edit', $data);
    }

    public function update (UpdateConfigRequest $request) {
        $validated = $request->validated();//dd($validated);

        if (isset($validated['logo'])) {
            $logo = $validated['logo'];

            $logo_name = Together::image_name($logo);

            $path = 'public/uploads/config/' . $logo_name;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $logo->storeAs('public/uploads/config', $logo_name);
            }
        } else {
            $logo_name = '';
        }

        if (isset($validated['icon'])) {
            $icon = $validated['icon'];

            $icon_name = Together::image_name($icon);

            $path = 'public/uploads/config/' . $icon_name;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $icon->storeAs('public/uploads/config', $icon_name);
            }
        } else {
            $icon_name = '';
        }

        $banner_1 = $request->file('banner_1');
        if ($banner_1 !== null) {
            $banner_1_name = Together::image_name($banner_1);

            $path = 'public/uploads/config/' . $banner_1_name;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $banner_1->storeAs('public/uploads/config', $banner_1_name);
            }
        } else {
            $banner_1_name = '';
        }

        $banner_2 = $request->file('banner_2');
        if ($banner_2 !== null) {
            $banner_2_name = Together::image_name($banner_2);

            $path = 'public/uploads/config/' . $banner_2_name;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $banner_2->storeAs('public/uploads/config', $banner_2_name);
            }
        } else {
            $banner_2_name = '';
        }

        $banner_3 = $request->file('banner_3');
        if ($banner_3 !== null) {
            $banner_3_name = Together::image_name($banner_3);

            $path = 'public/uploads/config/' . $banner_3_name;
            if (Storage::get($path)) {
                // echo 'đã có';
            } else {
                // echo 'không có';
                $path = $banner_3->storeAs('public/uploads/config', $banner_3_name);
            }
        } else {
            $banner_3_name = '';
        } 
        
        $config = Config::find(1);
        $config->title = $request->input('title');
        $config->description = $request->input('description');
        $config->keyword = $request->input('keyword');
        $config->intro = $request->input('intro');

        $config->content_home_1 = $request->input('content_home_1');
        $config->content_home_2 = $request->input('content_home_2');
        $config->content_home_3 = $request->input('content_home_3');
        $config->content_home_4 = $request->input('content_home_4');
        $config->content_home_5 = $request->input('content_home_5');
        $config->content_home_6 = $request->input('content_home_6');
        $config->content_home_7 = $request->input('content_home_7');
        $config->content_home_8 = $request->input('content_home_8');
        $config->content_home_9 = $request->input('content_home_9');
        $config->content_home_10 = $request->input('content_home_10');

        $config->embed_code_header = $request->input('embed_code_header');
        $config->embed_code_footer = $request->input('embed_code_footer');

        if (!empty($logo_name)) {
            $config->logo = $logo_name;
        }
        if (!empty($icon_name)) {
            $config->icon = $icon_name;
        }

        if (!empty($banner_1_name)) {
            $config->banner_1 = $banner_1_name;
        }
        if (!empty($banner_2_name)) {
            $config->banner_2 = $banner_2_name;
        }
        if (!empty($banner_3_name)) {
            $config->banner_3 = $banner_3_name;
        }
        
        $config->save();
        
        $errors = ['Cập nhập thành công'];
        return redirect('admin/config')
                        ->withErrors($errors);
    }

    public function dashBoard()
    {
        $cart_count = DB::table('carts')->count();
        $product_count = DB::table('products')->count();
        $post_count = DB::table('posts')->count();
        $page_count = DB::table('pages')->count();
        $data = [
            'cart_count' => $cart_count,
            'product_count' => $product_count,
            'post_count' => $post_count,
            'page_count' => $page_count,
        ];
        $data['menu_active'] = Together::check_url_menu();
        return view('admin/dashboard', $data);
    }
}
