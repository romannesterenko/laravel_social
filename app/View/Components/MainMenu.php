<?php

namespace App\View\Components;

use App\Models\ChatMessage;
use Auth;
use Illuminate\View\Component;

class MainMenu extends Component
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
        return view('components.main-menu', ['count_messages' => ChatMessage::where('recipient_id', Auth::id())->where('read', 0)->get()->count()]);
    }
}
