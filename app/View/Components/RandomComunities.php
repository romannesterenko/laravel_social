<?php

namespace App\View\Components;

use App\Models\Community;
use Illuminate\View\Component;

class RandomComunities extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $communities = Community::paginate(5);
        return view('components.random-comunities', compact('communities'));
    }
}
