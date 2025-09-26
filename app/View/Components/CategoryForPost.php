<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\NewsCat;

class CategoryForPost extends Component
{
    public $checkbox_list;
    public $checkbox = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($newscatId)
    {
        $this->checkbox_list = $this->getListCategory($newscatId);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.category-for-post');
    }

    public function getListCategory ($newscat_id) {
        $newscat_id_arr = json_decode($newscat_id);
        if (empty($newscat_id)) {
            $newscat_id_arr = [];
        }
        // dd($newscat_id_arr);

        // list newscat cấp 1, đối với edit post, checked đối với đã chọn.
        $level_1 = NewsCat::where('parent_id', 0)->orderBy('sort')->get();
        $this->checkbox = '<div class="form-control" style="height: auto;">';

        foreach ($level_1 as $item) {
            $checked = '';
            if (in_array($item['id'], $newscat_id_arr)) {
                $checked = 'checked';
            }
            $this->checkbox .= '<div class="form-check">
                <input type="checkbox" name="newscat_id[]" value="'.$item['id'].'" '.$checked.'>
                <label class="form-check-label"> '.$item['title'].'</label>
            </div>
            ';
            $this->level_child($item['id'], 0, $newscat_id_arr);
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
        $level_next = NewsCat::where('parent_id', $id)->orderBy('sort')->get();

        foreach ($level_next as $item) {
            $checked = '';
            if (in_array($item['id'], $id_arr)) {
                $checked = 'checked';
            }
            $this->checkbox .= '<div class="form-check">'.$tab.'
                <input type="checkbox" name="newscat_id[]" value="'.$item['id'].'" '.$checked.'>
                <label class="form-check-label"> '.$item['title'].'</label>
            </div>
            ';
            $this->level_child($item['id'], $level, $id_arr);
        }
    }
}
