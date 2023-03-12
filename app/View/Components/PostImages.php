<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostImages extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Admin\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-images', ['post' => $this->post]);
    }
}
