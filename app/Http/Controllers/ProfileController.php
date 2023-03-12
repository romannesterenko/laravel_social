<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Community;
use App\Models\CommunityUser;
use App\Models\Image;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('author', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        if($request->ajax=='Y'){
            return view('ajax.posts', compact('posts'));
        }
        return view('profile.index', compact('posts'));
    }
    public function about()
    {
        return view('profile.about');
    }

    public function add_post()
    {
        $ids = [];
        $subs = CommunityUser::where('user_id', \Auth::id())->get();
        foreach ($subs as $sub)
            $ids[] = $sub->community_id;
        $communities = Community::where('author', \Auth::id())->orWhere('id', $ids)->get();
        return view('profile.post.add', compact('communities'));
    }
    public function edit_post($id)
    {
        $post = Post::find($id);
        return view('profile.post.edit', compact('post'));
    }
    public function edit()
    {
        return view('profile.edit');
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        if($user){
            if($request->delete_avatar==1&&$user->avatar){
                $file_path = public_path('/images/profile/avatars/').$user->avatar;
                if(File::exists($file_path)) {
                    unlink($file_path); //delete from storage
                    $user->avatar = null;
                }
            }
            if($request->delete_fon_image==1&&$user->fon_image){
                $file_path = public_path('/images/profile/fon_src/').$user->fon_image;
                if(File::exists($file_path)) {
                    unlink($file_path);
                    $user->fon_image = null;
                }
            }
            if($request->hasFile('avatar')) {
                $path = public_path('/images/profile/avatars');
                if ( ! file_exists($path) )
                    mkdir($path, 0777, true);
                $file = $request->file('avatar');
                $avatar = uniqid() . '_.' . $file->getClientOriginalExtension();
                $file->move($path, $avatar);
                $user->avatar = $avatar;
            }

            if($request->hasFile('fon_image')) {
                $path = public_path('/images/profile/fon_src');
                if ( ! file_exists($path) )
                    mkdir($path, 0777, true);
                $file = $request->file('fon_image');
                $fon_image = uniqid() . '_.' . $file->getClientOriginalExtension();
                $file->move($path, $fon_image);
                $user->fon_image = $fon_image;
            }



            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->profession = $request->profession;
            $user->birthday = $request->birthday;
            $user->hobby = $request->hobby;
            $user->country = $request->country;
            $user->about = $request->about;
            $user->save();
            return redirect()->route('profile.edit')->withSuccess('Update success');
        }
        return redirect()->route('profile.edit')->withErrors('User not found');
    }
}
