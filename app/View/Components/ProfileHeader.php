<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileHeader extends Component
{
    public string $name;
    public $avatar;
    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $user,
    )
    {
        $this->name = $user->name;
        $this->avatar = $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF';
        $this->description = $user->description ?? 'This user is hiding something...';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile-header');
    }
}
