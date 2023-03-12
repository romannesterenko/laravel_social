<?php

namespace App\View\Components;

use App\Models\Community;
use Illuminate\View\Component;

class ListCommunityItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Community $community)
    {
        $this->community = $community;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-community-item', ['community' => $this->community]);
    }
}
