<?php

namespace App\View\Components;

use App\Models\Community;
use Illuminate\View\Component;

class CommunityBlockComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->community = Community::find($id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.community-block-component', ['community' => $this->community]);
    }
}
