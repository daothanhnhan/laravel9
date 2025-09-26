<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ProductCat;

class ProductCategorySelect extends Component
{
    public $select_list;
    public $select;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productcatId)
    {
        $this->select_list = $this->getSelect($productcatId);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.product-category-select');
    }

    public function getSelect($productcat_id): string
    {
        // danh sách câp 1
        $level_1 = ProductCat::where('parent_id', 0)->orderBy('sort')->get();
        
        if ($productcat_id == 0) {
            $productcat['parent_id'] = 0;
        } else {
            $productcat = ProductCat::where('id', $productcat_id)->first();
        }
        
        // không được chọn chính nó và con của nó
        // show phần đã chọn
        $this->select = '<option value="0">Cấp cha</option>';
        foreach ($level_1 as $option) {
            if ($option['id'] == $productcat_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$option['title'].'</option>';
                continue;
            }

            $selected = '';
            if ($option['id'] == $productcat['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$option['title'].'</option>';
            $this->level_child($option['id'], 0, $productcat_id);
        }
        return $this->select;
    }

    public function level_child ($id, $level, $productcat_id) {
        $level++;
        $tab = '';
        for ($i=0;$i<$level;$i++) {
            $tab .= '|--';
        }

        if ($productcat_id == 0) {
            $productcat['parent_id'] = 0;
        } else {
            $productcat = ProductCat::where('id', $productcat_id)->first();
        }

        $level_next = ProductCat::where('parent_id', $id)->orderBy('sort')->get();

        // không được chọn chính nó và con của nó
        // show phần đã chọn
        foreach ($level_next as $option) {
            if ($option['id'] == $productcat_id) {
                $this->select .= '<option value="'.$option['id'].'" disabled >'.$tab.' '.$option['title'].'</option>';
                continue;
            }
            
            $selected = '';
            if ($option['id'] == $productcat['parent_id']) {
                $selected = 'selected';
            }

            $this->select .= '<option value="'.$option['id'].'" '.$selected.' >'.$tab.' '.$option['title'].'</option>';
            $this->level_child($option['id'], $level, $productcat_id);
        }
    }
}
