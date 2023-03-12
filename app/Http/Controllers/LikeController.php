<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Coment;
use App\Models\CommentLikes;
use App\Models\PostLikes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private function removeLike($request){
        if($request->entity=='post')
            $like = PostLikes::where($request->entity, $request->id)->where('user', Auth::id())->where('value', 'like')->first();
        else
            $like = CommentLikes::where($request->entity, $request->id)->where('user', Auth::id())->where('value', 'like')->first();
        $like->delete();
    }
    private function removeDislike($request){
        if($request->entity=='post')
            $like = PostLikes::where($request->entity, $request->id)->where('user', Auth::id())->where('value', 'dislike')->first();
        else
            $like = CommentLikes::where($request->entity, $request->id)->where('user', Auth::id())->where('value', 'dislike')->first();
        $like->delete();
    }
    public function store(Request $request){
        if(!Auth::check())
            return response()->json(['title' => 'Nie jesteś upoważniony', 'body' => 'Nie jesteś upoważniony! Kliknij <a href="'.route('login').'">łącze</a>, aby uzyskać autoryzację'], 401);
        if($request->entity=='post'){
            if($request->action=='like'){
                $post = Post::find($request->id);
                if($post->isLiked()){
                    $this->removeLike($request);
                }else{
                    if($post->isDisliked()){
                        $this->removeDislike($request);
                    }
                    $like = new PostLikes();
                    $like->post = $request->id;
                    $like->value = $request->action;
                    $like->user = Auth::id();
                    $like->save();
                }
            } elseif ($request->action=='dislike') {
                $post = Post::find($request->id);
                if($post->isDisliked()){
                    $this->removeDislike($request);
                }else{
                    if($post->isLiked()){
                        $this->removeLike($request);
                    }
                    $like = new PostLikes();
                    $like->post = $request->id;
                    $like->value = $request->action;
                    $like->user = Auth::id();
                    $like->save();
                }
            }
            return response()->json(['success' => true]);
        }
        if($request->entity=='coment'){
            if($request->action=='like'){
                $coment = Coment::find($request->id);
                if($coment->isLiked()){
                    $this->removeLike($request);
                }else{
                    if($coment->isDisliked()){
                        $this->removeDislike($request);
                    }
                    $like = new CommentLikes();
                    $like->coment = $request->id;
                    $like->value = $request->action;
                    $like->user = Auth::id();
                    $like->save();
                }
            } elseif ($request->action=='dislike') {
                $coment = Coment::find($request->id);
                if($coment->isDisliked()){
                    $this->removeDislike($request);
                }else{
                    if($coment->isLiked()){
                        $this->removeLike($request);
                    }
                    $like = new CommentLikes();
                    $like->coment = $request->id;
                    $like->value = $request->action;
                    $like->user = Auth::id();
                    $like->save();
                }
            }
            return response()->json(['success' => true]);
        }
    }
}
