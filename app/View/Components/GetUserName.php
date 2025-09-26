<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class GetUserName extends Component
{
    // public $creator_id;
    public $username;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($creatorId)
    {
        // tên biến chuyền vào không được có ký tự _
        // $this->creator_id = $creator_id;
        $user = User::find($creatorId);
        if ($user) {
            $this->username = $user->name;
            return true;
        } else {
            $this->username = '';
            return true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.get-user-name');
    }
}
