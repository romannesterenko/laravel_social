<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use View;
class InboxController extends Controller
{
    public function index(){
        $threads = ChatThread::where('user_one', Auth::id())->orWhere('user_two', Auth::id())->get();
        return view('inbox.index', compact('threads'));
    }

    public function get_thread_ajax(Request $request)
    {
        $thread = ChatThread::find($request->id);
        if($thread)
            return View::make("components.chat-messages", ['messages' => $thread->messages])->render();
    }

    public function add_message($id, Request $request)
    {
        $message = new ChatMessage();
        $message->author_id = $request->author_id;
        $message->recipient_id = $request->recipient_id;
        $message->message = $request->message;
        $message->thread_id = $id;
        $message->save();
        echo json_encode(['success' => true]);
    }

    public function show($user_id)
    {
        $thread = ChatThread::whereIn('user_one', [$user_id, Auth::id()])->whereIn('user_two', [$user_id, Auth::id()])->first();
        if(!$thread){
            $thread = new ChatThread();
            $thread->user_one = Auth::id();
            $thread->user_two = (int)$user_id;
            $thread->save();
        }
        foreach ($thread->unread_messages() as $unread_message) {
            $unread_message->read = 1;
            $unread_message->save();
        }
        $recipient = $thread->user_one == Auth::id()?$thread->chatMemberTwo:$thread->chatMemberOne;
        $author = $thread->user_one == Auth::id()?$thread->chatMemberOne:$thread->chatMemberTwo;
        $threads = ChatThread::where('user_one', Auth::id())->orWhere('user_two', Auth::id())->get();
        return view('inbox.chat', compact('threads', 'thread', 'recipient', 'author'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
