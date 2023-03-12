<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){

        $posts = Post::paginate(20);
        return view('admin.posts.index', compact('posts'));

    }
    public function create(){

        return view('admin.posts.create');

    }
    public function show($id){
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));

    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('admin.posts.create')
                ->withErrors($validator)
                ->withInput();
        }
        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'author' => $request->author,
            'community' => $request->community,
            'likes' => 0,
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
                ->route('admin.posts.show', $post)
                ->withSuccess('Post create successful');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('admin.posts.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        $post = Post::find($id);
        $post->title = $request->title;
        $post->text = $request->text;

        if($post->save()){
            return redirect()
                ->route('admin.posts.show', $post)
                ->withSuccess('Update success');
        }else{
            return redirect()
                ->route('admin.posts.edit', $id)
                ->withErrors('Update failed');
        }
    }
}
