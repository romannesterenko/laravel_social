<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Community;
use App\Models\CommunityTypes;
use App\Models\CommunityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use View;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::paginate(20);
        return view('groups.index', compact('communities'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        $communities = Community::where('author', \Auth::id())->get();
        return view('groups.my', compact('communities'));
    }
    public function subscribed()
    {
        $ids = [];
        $subs = CommunityUser::where('user_id', \Auth::id())->get();
        foreach ($subs as $sub)
            $ids[] = $sub->community_id;
        $communities = Community::where('id', $ids)->paginate(20);
        return view('groups.subscribed', compact('communities'));
    }
    public function subscribers($group_id)
    {
        $community = Community::find($group_id);
        $subscribers = CommunityUser::where('community_id', $community->id)->paginate(20);
        return view('groups.subscribers', compact('community', 'subscribers'));
    }

    public function getMeta(Request $request){
        $community = Community::find($request->id);
        echo View::make("groups.meta", ['community' => $community])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $community_types = CommunityTypes::all();
        return view('groups.create', compact('community_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id, Request $request)
    {
        $community = Community::find($id);
        $posts = Post::where('community', $id)->orderByDesc('id')->paginate(5);
        if($request->ajax=='Y'){
            return view('ajax.posts', compact('posts'));
        }
        return view('groups.detail', compact('community', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('groups.create')
                ->withErrors($validator)
                ->withInput();
        }
        $community = Community::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
        ]);

        if($community) {
            if($request->hasFile('image')) {
                $path = public_path('/images/groups/avatars');
                if ( ! file_exists($path) )
                    mkdir($path, 0777, true);
                $file = $request->file('image');
                $avatar = uniqid() . '_.' . $file->getClientOriginalExtension();
                $file->move($path, $avatar);
                $community->image = $avatar;
                $community->save();
            }
            return redirect()
                ->route('groups.index')
                ->withSuccess('Community create successful');
        }
    }
    public function subscribe(Request $request)
    {
        if($request->data["action"]=='subscribe'){
            $subscribed_user = CommunityUser::create([
                'user_id' => $request->data["user_id"],
                'community_id' => $request->data["community_id"],
                'role' => 'user',
            ]);
            if($subscribed_user)
                return response()->json(['request' => $request->all(), 'action' => $request->data["action"], 'success' => true]);
        } elseif ($request->data["action"]=='unsubscribe'){
            $subscribed = CommunityUser::where('community_id', $request->data["community_id"])->where('user_id', $request->data["user_id"])->first();
            if($subscribed)
                $subscribed->delete();
            return response()->json(['request' => $request->all(), 'action' => $request->data["action"], 'success' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $community_types = CommunityTypes::all();
        $community = Community::find($id);
        return view('groups.edit', compact('community_types', 'community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $community = Community::find($request->community);

        if($community){
            if($request->delete_fon_image==1&&$community->image){
                $file_path = public_path($community->avatar_src);
                if(File::exists($file_path)) {
                    unlink($file_path);
                    $community->image = null;
                }
            }
            if($request->hasFile('image')) {
                $old_file_path = public_path($community->avatar_src);
                if(File::exists($old_file_path)) {
                    unlink($old_file_path);
                    $community->image = null;
                }
                $path = public_path('/images/groups/avatars');
                if ( ! file_exists($path) )
                    mkdir($path, 0777, true);
                $file = $request->file('image');
                $avatar = uniqid() . '_.' . $file->getClientOriginalExtension();
                $file->move($path, $avatar);
                $community->image = $avatar;
            }
            $community->title = $request->title;
            $community->description = $request->description;
            $community->category = $request->category;
            $community->save();
            return redirect()->route('groups.edit', $community)->withSuccess('Update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
