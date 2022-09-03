<?php

namespace App\View\Components;

use App\Enums\LessonStatusEnum;
use Illuminate\View\Component;

class Rating extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(LessonStatusEnum::canBeRating($this->status)){
            return view('components.rating.basic');
        }
        elseif(LessonStatusEnum::canBeRating($this->status)){
            return view('components.rating.rated');
        }
    }
}
