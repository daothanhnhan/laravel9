<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class MenuSelect extends Component
{
    public $select_list;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menuId)
    {
        $this->select_list = $this->getSelect($menuId);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.menu-select');
    }

    public function getSelect($menu_id): string
    {
        // biến được chuyền vào file view trước , và được khái bảo trong controller
        $level_1 = Menu::where('parent_id', 0)->orderBy('sort')->get();
        
        if ($menu_id == 0) {
            $menu['parent_id'] = 0;
        } else {
            $menu = Menu::where('id', $menu_id)->first();
        }
        
        // không được chọn chính nó và con của nó.
        // seleced cha
        $this->select = '<option value="0">Cấp cha</option>';
        foreach ($level_1 as $option) {
            // $option = (array)$option;
            $option = $option->toArray();
            // dd($option);
            if (array_key_exists('title', $option)) {
                $title = $option['title'];
            } else {
                $title = $option['name'];
            }

            if ($option['id'] == $menu_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$title.'</option>';
                continue;
            }

            $selected = '';
            if ($option['id'] == $menu['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$title.'</option>';
            $this->level_child($option['id'], 0, $menu_id);
        }
        return $this->select;
    }

    public function level_child ($id, $level, $menu_id) {
        $level++;
        $tab = '';
        for ($i=0;$i<$level;$i++) {
            $tab .= '|--';
        }

        if ($menu_id == 0) {
            $menu['parent_id'] = 0;
        } else {
            $menu = Menu::where('id', $menu_id)->first();
        }

        $level_next = Menu::where('parent_id', $id)->orderBy('sort')->get();

        // không được chọn nó và con của nó.
        // seleced cha
        foreach ($level_next as $option) {
            // $option = (array)$option;
            $option = $option->toArray();
            if (array_key_exists('title', $option)) {
                $title = $option['title'];
            } else {
                $title = $option['name'];
            }
            
            if ($option['id'] == $menu_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$tab.' '.$title.'</option>';
                continue;
            }
            
            $selected = '';
            if ($option['id'] == $menu['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$tab.' '.$title.'</option>';
            $this->level_child($option['id'], $level, $menu_id);
        }
    }
}
