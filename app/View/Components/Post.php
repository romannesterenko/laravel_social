<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Admin\Post $post)
    {
        $this->post = $post;
        $text = $this->post->text;
        $this->post->text = preg_match("/^((\S+\s+){30})/s", $text, $m) ? $m[1] . '...' : $text;
        \Carbon\Carbon::setLocale('pl');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post', ['post' => $this->post]);
    }
}
