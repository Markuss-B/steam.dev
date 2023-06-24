<?php

namespace App\View\Components\scroller;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class container extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $view,
        public $data,
    )
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scroller.container')->with([
            'view' => $this->view,
            'data' => $this->data,
        ]);
    }
}
