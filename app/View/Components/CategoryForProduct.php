<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ProductCat;

class CategoryForProduct extends Component
{
    public $checkbox_list;
    public $checkbox;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productcatId)
    {
        $this->checkbox_list = $this->getListCategory($productcatId);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.category-for-product');
    }

    public function getListCategory ($productcat_id) {
        $productcat_id_arr = json_decode($productcat_id);
        if (empty($productcat_id)) {
            $productcat_id_arr = [];
        }

        $level_1 = ProductCat::where('parent_id', 0)->orderBy('sort')->get();
        $this->checkbox = '<div class="form-control" style="height: auto;">';

        foreach ($level_1 as $item) {
            $checked = '';
            if (in_array($item['id'], $productcat_id_arr)) {
                $checked = 'checked';
            }
            $this->checkbox .= '<div class="form-check">
                <input type="checkbox" name="productcat_id[]" value="'.$item['id'].'" '.$checked.'>
                <label class="form-check-label"> '.$item['title'].'</label>
            </div>
            ';
            $this->level_child($item['id'], 0, $productcat_id_arr);
        }

        $this->checkbox .= '</div>';

        return $this->checkbox;
    }

    public function level_child ($id, $level, $id_arr) {
        $level++;
        $tab = '';
        for ($i=0; $i<$level; $i++) {
            $tab .= '|--';
        }
        $level_next = ProductCat::where('parent_id', $id)->orderBy('sort')->get();

        foreach ($level_next as $item) {
            $checked = '';
            if (in_array($item['id'], $id_arr)) {
                $checked = 'checked';
            }
            $this->checkbox .= '<div class="form-check">'.$tab.'
                <input type="checkbox" name="productcat_id[]" value="'.$item['id'].'" '.$checked.'>
                <label class="form-check-label"> '.$item['title'].'</label>
            </div>
            ';
            $this->level_child($item['id'], $level, $id_arr);
        }
    }
}
