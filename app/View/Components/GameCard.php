<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $game,
        public $link = '',
        public bool $showPrice = false
    )
    {
        $this->game = $game;
        $this->link = $link;
        $this->showPrice = $showPrice;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-card');
    }
}
