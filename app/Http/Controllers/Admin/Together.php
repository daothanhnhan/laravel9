<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Together extends Controller
{
    public static function slug_add ($model, $slug) {

        $table = DB::table($model)->where('slug', $slug)->first();

        if (empty($table)) {
            // trường hợp chưa có slug nào.
            return $slug;
        } else {
            // thêm  -1 vào slug
            // kiểm tra đã có chưa
            // nếu chưa có thì dùng, nếu có rồi thì tâng đuôi thêm một.
            $slug_origin = $slug;

            $slug = $slug . '-1';
            $slug_new = $slug;
            $table = DB::table($model)->where('slug', $slug)->first();

            $i = 1;
            while (!empty($table)) {
                $i++;
                $slug = $slug_origin . '-' . $i;
                $slug_new = $slug;
                $table = DB::table($model)->where('slug', $slug)->first();
            }

            return $slug_new;
        }
    }

    public static function slug_edit ($model, $slug, $id) {
        // $tableModel = DB::table($model);// chỉ sài được một lần

        // kiểm tra xem slug có thay đổi hay không.
        // kiểm tra slug trong db và trong đầu vào.
        $table_id =  DB::table($model)->where('id', $id)->first();
        // dd($page_id['slug']);
        if ($table_id->slug == $slug) {
            return $slug;
        }

        // kiểm tra xem có bị trùng hay không.
        $table_slug =  DB::table($model)->where('slug', $slug)->first();//dd($table_slug);

        if (empty($table_slug)) {
            return $slug;
        } else {
            // thêm  -1 vào slug
            // kiểm tra đã có chưa
            // nếu chưa có thì dùng, nếu có rồi thì tâng đuôi thêm một.
            $slug_origin = $slug;

            $slug = $slug . '-1';
            $slug_new = $slug;
            $table = DB::table($model)->where('slug', $slug)->first();

            $i = 1;
            while (!empty($table)) {
                $i++;
                $slug = $slug_origin . '-' . $i;
                $slug_new = $slug;
                $table = DB::table($model)->where('slug', $slug)->first();
            }

            return $slug_new;
        }
    }

    public static function check_url_menu () {
        $url = url()->current();
        $arr = ['user', 'slide', 'page', 'newscat', 'post', 'productcat', 'product', 'cart', 'config', 'menu', 'contact', 'video'];

        foreach ($arr as $item) {
            $pos = strpos($url, $item);
            if ($pos !== false) {
                return $item;
            }
        }

        return '';
    }

    public function thay_duoi ($slug) {
        // kiểm tra đuôi có phải là só hay không
        // nếu không thì thêm -1
        // nếu có thì tăng lên một
        $arr = explode('-', $slug);
        if (is_numeric(end($arr))) {
            $i = end($arr);
            array_pop($arr);
            $arr[]     = ++$i;
            $slug_new = implode('-', $arr);
        } else {
            $slug_new = $slug . '-1';
        }
    }

    public static function image_name ($file) {
        $extension = $file->extension();
        $img_name = $file->getClientOriginalName();
        $img_name = collect($img_name)->remove_extension_file()[0];
        $img_name = Str::of($img_name)->slug('-');
        $img_name_new = $img_name.'.'.$extension;

        return $img_name_new;
    }
}
