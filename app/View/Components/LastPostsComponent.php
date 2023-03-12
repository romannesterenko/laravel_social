<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use App\Models\Admin\Post;

class LastPostsComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check())
            $this->posts = Post::where('author', '!=', Auth::id())->orderByDesc('created_at')->limit(5)->get();
        else
            $this->posts = Post::orderByDesc('created_at')->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.last-posts-component', ['posts' => $this->posts]);
    }
}
