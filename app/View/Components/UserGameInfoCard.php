<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserGameInfoCard extends Component
{
    public $last_played;
    public $play_time;
    public $acquisition_date;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $game,
        public $user,
    )
    {
        $this->game = $game;
        $this->user = $user;
        $this->last_played = $this->game->pivot->last_played;
        if ($this->last_played) {
            $this->last_played = $this->last_played->format('Y-m-d');
        }
        $this->play_time = $this->game->pivot->play_time;
        $this->acquisition_date = $this->game->pivot->acquisition_date->format('Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-game-info-card');
    }
}
