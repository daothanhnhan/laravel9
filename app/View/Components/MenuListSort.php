<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class MenuListSort extends Component
{
    public $list;
    public $stt = 0;
    public $ol = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->list = $this->getOlList();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.menu-list-sort');
    }

    public function getOlList () {
        // biến được chuyền vào file view trước , và được khái bảo trong controller 
        $level_1 = Menu::where('parent_id', 0)->orderBy('sort')->get();

        $this->ol = '<ol class="dd-list">';
        $this->stt = 0;
        foreach ($level_1 as $item) {
            $this->stt++;

            $this->ol .= '<li class="dd-item dd3-item" data-id="'.$item->id.'">';
            $this->ol .= '<div class="dd-handle dd3-handle"></div>';
            $this->ol .= '<div class="dd3-content">';
            $this->ol .= '<a href="/admin/menus/'. $item->id .'/edit">'.$item->name.'</a>';
            $this->ol .= '</div>';
            $this->level_child($item->id);
            $this->ol .= '</li>';
            
        }
        $this->ol .= '</ol>';

        return $this->ol;
    }

    public function level_child ($id) {

        $level_next = Menu::where('parent_id', $id)->orderBy('sort')->get();
        if (!empty($level_next)) {
            $this->ol .= '<ol class="dd-list">';
            foreach ($level_next as $item) {
                $this->stt++;
                
                $this->ol .= '<li class="dd-item dd3-item" data-id="'.$item->id.'">';
                $this->ol .= '<div class="dd-handle dd3-handle"></div>';
                $this->ol .= '<div class="dd3-content">';
                $this->ol .= '<a href="/admin/menus/'.$item['id'].'/edit">'.$item->name.'</a>';
                $this->ol .= '</div>';
                $this->level_child($item->id);
                $this->ol .= '</li>';
                
            }
            $this->ol .= '</ol>';
        }
    }
}
