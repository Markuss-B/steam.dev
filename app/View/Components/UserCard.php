<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class UserCard extends Component
{
    public string $name;
    public $avatar;
    public $activeGame;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $user,
    )
    {
        $this->name = $user->name;
        $this->avatar = $user->getAvatarUrlAttribute();
        $this->activeGame = $user->activeGame;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-card');
    }
}
