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
        public string $id = '',
        public bool $loadOnButtonPress = false,
    )
    {
        if (!$id)
        {
            $this->id = $view;
        } else {
            $this->id = $id;
        }
        $this->view = $view;
        $this->data = $data;
        $this->loadOnButtonPress = $loadOnButtonPress;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scroller.container')->with([
            'id' => $this->id,
            'view' => $this->view,
            'data' => $this->data,
        ]);
    }
}
