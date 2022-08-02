<?php

namespace App\View\Components;

use App\Enums\LevelEnum;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (isset($this->user->level)) {
            return view('components.navbar.instructor');
        } elseif (auth('driver')->check()) {
            return view('components.navbar.driver');
        }
    }
}
