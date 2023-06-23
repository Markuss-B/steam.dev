<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameRow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $game,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-row');
    }
}
