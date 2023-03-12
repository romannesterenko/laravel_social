<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'recipient_id',
        'message',
        'thread_id',
        'author_deleted',
        'recipient_deleted',
        'read',
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function recipient()
    {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }

    public function thread()
    {
        return $this->belongsTo(ChatThread::class, 'id', 'thread_id');
    }

}
