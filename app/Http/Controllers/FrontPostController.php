<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Coment;
use App\Models\Image;
use App\Models\PostLikes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;

class FrontPostController extends Controller
{
    public function quick_add(Request $request)
    {
        $post = Post::create([
            'title' => $request->text,
            'text' => $request->text,
            'likes' => 0,
            'author' => $request->author,
            'community' => $request->community,
            'comments' => 0,
            'shares' => 0,
        ]);
        if($post) {
            return redirect()
                ->route('profile.index')
                ->withSuccess('Post create successful');
        }
    }

    public function getMeta(Request $request){
        if($request->entity=='coment'){
            $coment = Coment::find($request->id);
            echo View::make("components.comment-meta", ['coment' => $coment])->render();
        } else {
            $post = Post::find($request->id);
            echo View::make("components.post-meta", ['post' => $post])->render();
        }
    }

    public function add_post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('profile.post.add')
                ->withErrors($validator);
        }
        $post = Post::create([
            'title' => trim($request->title),
            'text' => trim($request->text),
            'typePost' => $request->typePost,
            'video' => $request->video,
            'community' => $request->community,
            'likes' => 0,
            'author' => $request->author,
            'comments' => 0,
            'shares' => 0,
        ]);
        if($post) {
            if(count(Auth::user()->unused_images())>0){
                foreach (Auth::user()->unused_images() as $image){
                    $image->post_id = $post->id;
                    $image->save();
                }
            }
            return redirect()
                ->route('profile.index')
                ->withSuccess('Post create successful');
        }
    }

    public function update_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $post = Post::find($id);
        $post->title = trim($request->title);
        $post->text = trim($request->text);
        $post->typePost = $request->typePost;
        $post->video = $request->video;
        $post->save();
        return redirect()
            ->route('profile.index')
            ->withSuccess('Post update successful');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        \Carbon\Carbon::setLocale('pl');
        return view('post', compact('post'));
    }

    public function delete($id){
        Post::find($id)->delete();
        //$post->delete();
    }
}
