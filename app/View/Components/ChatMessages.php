<?php

namespace App\View\Components;

use App\Models\ChatThread;
use Illuminate\View\Component;

class ChatMessages extends Component
{
    public ChatThread $thread;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ChatThread $thread)
    {
        $this->thread = $thread;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat-messages', ['messages' => $this->thread->messages]);
    }
}
