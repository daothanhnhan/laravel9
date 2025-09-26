<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class MenuList extends Component
{
    public $table;
    public $stt = 0;
    public $tr = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = $this->getTrTable();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.menu-list');
    }

    public function getTrTable () {
        // biến được chuyền vào file view trước , và được khái bảo trong controller 
        $level_1 = Menu::where('parent_id', 0)->orderBy('sort')->get();

        $this->tr = '';
        $this->stt = 0;
        foreach ($level_1 as $item) {

            $this->stt++;
            $this->tr .= '<tr>';
            $this->tr .= '<td>'.$this->stt.'</td>';
            $this->tr .= '<td><a href="/admin/menus/'. $item['id'] .'/edit">'.$item['name'].'</a></td>';
            $this->tr .= '<td>'.collect($item['state'])->get_state()[0].'</td>';
            $this->tr .= '<td>
                            <a href="/admin/menus/'. $item['id'] .'/edit">Edit</a> |
                            <form action="/admin/menus/'. $item['id'] .'" method="POST" style="display: inline;" class="form-delete">
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

        $level_next = Menu::where('parent_id', $id)->orderBy('sort')->get();

        foreach ($level_next as $item) {
            $this->stt++;
            $this->tr .= '<tr>';
            $this->tr .= '<td>'.$this->stt.'</td>';
            $this->tr .= '<td><a href="/admin/menus/'. $item['id'] .'/edit">'.$tab.' '.$item['name'].'</a></td>';
            $this->tr .= '<td>'.collect($item['state'])->get_state()[0].'</td>';
            $this->tr .= '<td>
                            <a href="/admin/menus/'. $item['id'] .'/edit">Edit</a> |
                            <form action="/admin/menus/'. $item['id'] .'" method="POST" style="display: inline;" class="form-delete">
                              <input type="hidden" name="_token" value="'.csrf_token().'" />
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit">Delete</button>
                            </form>
                          </td>';
            $this->tr .= '</tr>';
            
            $this->level_child($item['id'], $level);
        }
    }
}
