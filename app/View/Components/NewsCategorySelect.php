<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\NewsCat;

class NewsCategorySelect extends Component
{
    public $select_list;
    public $select;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->select_list = $this->getSelect($id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.news-category-select');
    }

    public function getSelect($newscat_id): string
    {
        // 
        $level_1 = NewsCat::where('parent_id', 0)->orderBy('sort')->get();
        
        // điều kiện chỉ hoạt động khi $newscat_id khác 0.
        // $newscat_id là id của newscat hiện tại.
        if ($newscat_id == 0) {
            $newscat['parent_id'] = 0;
        } else {
            $newscat = NewsCat::where('id', $newscat_id)->first();
        }
        

        $this->select = '<option value="0">Cấp cha</option>';
        foreach ($level_1 as $option) {
            // nó không thể chọn chính nó và con của nó
            // phần con bị ẩn
            if ($option['id'] == $newscat_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$option['title'].'</option>';
                continue;
            }

            // xác định phần mình đã chọn.
            $selected = '';
            if ($option['id'] == $newscat['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$option['title'].'</option>';
            $this->level_child($option['id'], 0, $newscat_id);
        }
        return $this->select;
    }

    public function level_child ($id, $level, $newscat_id) {
        $level++;
        $tab = '';
        for ($i=0;$i<$level;$i++) {
            $tab .= '|--';
        }

        if ($newscat_id == 0) {
            $newscat['parent_id'] = 0;
        } else {
            $newscat = NewsCat::where('id', $newscat_id)->first();
        }

        $level_next = NewsCat::where('parent_id', $id)->orderBy('sort')->get();

        foreach ($level_next as $option) {
            // nó không thể chọn chính nó và con của nó
            // phần con bị ẩn
            if ($option['id'] == $newscat_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$tab.' '.$option['title'].'</option>';
                continue;
            }
            
            // xác định phần mình đã chọn.
            $selected = '';
            if ($option['id'] == $newscat['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$tab.' '.$option['title'].'</option>';
            $this->level_child($option['id'], $level, $newscat_id);
        }
    }
}
