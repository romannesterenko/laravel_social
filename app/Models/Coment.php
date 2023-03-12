<?php

namespace App\Models;

use App\Models\Admin\Post;
use DOMDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Coment extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'coment',
        'user',
        'post',
        'parent_id',
        'likes',
        'level',
        'dislikes'
    ];

    public function childs()
    {
        return $this->hasMany(Coment::class, 'parent_id');
    }

    public function comentUser()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function commentPost()
    {
        return $this->hasOne(Post::class, 'id', 'post');
    }

    public function allowEdit():bool
    {
        return $this->comentUser->id==Auth::id();
    }

    public function delete()
    {
        if($this->childs())
            $this->childs()->delete();
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public function isLiked():bool{
        if(!Auth::check())
            return false;
        $like = CommentLikes::where('coment', $this->id)->where('user', Auth::id())->where('value', 'like')->first();
        return $like&&$like->id>0;
    }

    public function isDisliked():bool {
        if(!Auth::check())
            return false;
        $like = CommentLikes::where('coment', $this->id)->where('user', Auth::id())->where('value', 'dislike')->first();
        return $like&&$like->id>0;
    }

    public function likesAndDislikes(): HasMany
    {
        return $this->hasMany(CommentLikes::class, 'coment');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(CommentLikes::class, 'coment')->where('value', 'like');
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(CommentLikes::class, 'coment')->where('value', 'dislike');
    }

    public function getLikesCntAttribute():int {
        return $this->likes()->count();
    }

    public function getDislikesCntAttribute():int {
        return $this->dislikes()->count();
    }
}
