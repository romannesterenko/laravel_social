<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_one',
        'user_two',
        'user_one_deleted',
        'user_two_deleted'
    ];

    public function chatMemberOne()
    {
        return $this->hasOne(User::class, 'id', 'user_one');
    }

    public function chatMemberTwo()
    {
        return $this->hasOne(User::class, 'id', 'user_two');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'thread_id');
    }

    public function unread_messages()
    {
        return ChatMessage::where('read', 0)->where('thread_id', $this->id)->where('recipient_id', Auth::id())->get();
    }

    public function setRead()
    {
        return $this->hasMany(ChatMessage::class, 'thread_id')->where('read', 0);
    }
}
