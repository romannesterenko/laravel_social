<?php

namespace App\View\Components;

use App\Models\Coment;
use Illuminate\View\Component;

class CommentMeta extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Coment $coment)
    {
        $this->coment = $coment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment-meta', ['coment' => $this->coment]);
    }
}
