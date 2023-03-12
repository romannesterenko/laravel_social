<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        if($request->ajax=='Y'){
            return view('ajax.posts', compact('posts'));
        }
        return view('home', compact('posts'));
    }
    public function login(){
        return view('login');
    }
}
