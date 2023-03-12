<?php

namespace App\View\Components;

use App\Models\Coment;
use Illuminate\View\Component;

class Comments extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Admin\Post $post)
    {
        $this->post = $post;
        \Carbon\Carbon::setLocale('pl');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comments', ['post' => $this->post]);
    }
}
