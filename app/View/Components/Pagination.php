<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $paginate;

    public function __construct($paginate)
    {
       $this->paginate=$paginate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->paginate->totalPage=ceil($this->paginate->total() / $this->paginate->perPage());
        return view('components.pagination');
    }
}
