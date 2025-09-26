<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
	public $menu_str;

    public function header_menu () {
        $menus = DB::table('menus')->where('parent_id', 0)->where('state', 1)->orderBy('sort')->get();

        //active_mainMenu
        $this->menu_str = '<ul class="list_main_menu_1">';
        foreach ($menus as $menu) {
            $menu_link = $this->menu_info($menu);
            $this->menu_str .= '<li class="item_main_menu_1">';
            $this->menu_str .= '<a href="'.$menu_link.'" class="link_main_menu_1">'.$menu->name.'</a>';
            $this->header_menu_sub($menu->id, 1);
            $this->menu_str .= '</li>';
        }
        $this->menu_str .= '</ul>';

        return $this->menu_str;
    }

    public function header_menu_sub ($parent_id, $level) {
        $level++;
        $menus = DB::table('menus')->where('parent_id', $parent_id)->where('state', 1)->orderBy('sort')->get();

        if ($menus->isEmpty()) {
            return false;
        }
        //active_mainMenu
        $this->menu_str .= '<ul class="list_main_menu_'.$level.'">';
        foreach ($menus as $menu) {
            // dd($menu);
            $menu_link = $this->menu_info($menu);
            $this->menu_str .= '<li class="item_main_menu_'.$level.'">';
            $this->menu_str .= '<a href="'.$menu_link.'" class="link_main_menu_'.$level.'">'.$menu->name.'</a>';
            $this->header_menu_sub($menu->id, $level);
            $this->menu_str .= '</li>';
        }
        $this->menu_str .= '</ul>';

        // return $this->menu_str;
    }

    public function menu_info ($menu) {
        if (empty($menu->type)) {
            return '/'.$menu->link;
        }
        $model_item = DB::table($menu->type)->where('id', $menu->type_id)->first();
        if ($menu->type == 0) {
            return $menu->link;
        } else {
            $type = '';
            if ($menu->type == 'pages') {
                $type = '/page/';
            }
            if ($menu->type == 'news_cats') {
                $type = '/danh-muc-tin-tuc/';
            }
            if ($menu->type == 'posts') {
                $type = '/tin-tuc/';
            }
            if ($menu->type == 'product_cats') {
                $type = '/danh-muc-san-pham/';
            }
            if ($menu->type == 'products') {
                $type = '/san-pham/';
            }

            if (isset($model_item->slug)) {
                return $type.$model_item->slug;
            } else {
                return $model_item->link;
            }
            
        }
    }
}
