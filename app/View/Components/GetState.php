<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GetState extends Component
{
    public $state;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($state)
    {
        if ($state == 0) {
            $this->state = 'Ẩn';
            return true;
        }
        if ($state == 1) {
            $this->state = 'Hiện';
            return true;
        }
        $this->state = 'Khác';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.get-state');
    }
}
