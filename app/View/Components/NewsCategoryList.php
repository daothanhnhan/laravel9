<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\NewsCat;
use App\Models\User;

class NewsCategoryList extends Component
{
    public $table_list;
    public $stt = 0;
    public $tr = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table_list = $this->getTrTable();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.news-category-list');
    }

    public function demo () {
        return 'tuan';
    }

    public function getTrTable () {
        // show cấp cha
        $level_1 = NewsCat::where('parent_id', 0)->orderBy('sort')->get();

        $this->tr = '';
        $this->stt = 0;
        foreach ($level_1 as $item) {
            $this->stt++;
            $this->tr .= '<tr>';
            $this->tr .= '<td>'.$this->stt.'</td>';
            $this->tr .= '<td><a href="/admin/newscats/'. $item['id'] .'/edit">'.$item['title'].'</a></td>';
            $this->tr .= '<td>'.collect($item['creator_id'])->get_user_name()[0].'</td>';
            $this->tr .= '<td>
                            <a href="/admin/newscats/'. $item['id'] .'/edit">Edit</a> |
                            <form action="/admin/newscats/'. $item['id'] .'" method="POST" style="display: inline;" class="form-delete">
                              <input type="hidden" name="_token" value="'.csrf_token().'" />
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit">Delete</button>
                            </form>
                          </td>';
            $this->tr .= '</tr>';
            
            $this->level_child($item['id'], 0);
        }
        return $this->tr;
    }

    public function level_child ($id, $level) {
        $level++;
        $tab = '';
        for ($i=0;$i<$level;$i++) {
            $tab .= '|--';
        }

        $level_next = NewsCat::where('parent_id', $id)->orderBy('sort')->get();

        foreach ($level_next as $item) {
            $this->stt++;
            $this->tr .= '<tr>';
            $this->tr .= '<td>'.$this->stt.'</td>';
            $this->tr .= '<td><a href="/admin/newscats/'. $item['id'] .'/edit">'.$tab.' '.$item['title'].'</a></td>';
            $this->tr .= '<td>'.collect($item['creator_id'])->get_user_name()[0].'</td>';
            $this->tr .= '<td>
                            <a href="/admin/newscats/'. $item['id'] .'/edit">Edit</a> |
                            <form action="/admin/newscats/'. $item['id'] .'" method="POST" style="display: inline;" class="form-delete">
                              <input type="hidden" name="_token" value="'.csrf_token().'" />
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit">Delete</button>
                            </form>
                          </td>';
            $this->tr .= '</tr>';
            
            $this->level_child($item['id'], $level);
        }
    }

    // public function getUserName ($id) {
    //   $user = User::find($id);

    //   if ($user) {
    //     return $user->name;
    //   } else {
    //     return '';
    //   }
    // }
}
