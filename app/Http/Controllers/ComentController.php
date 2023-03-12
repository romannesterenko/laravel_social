<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentController extends Controller
{
    public function index()
    {
        $coments = Coment::paginate(20);
        return view('admin.coments.index', compact('coments'));
    }

    public function create_from_ui(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('posts.show', $request->post)
                ->withErrors($validator)
                ->withInput();
        }
        $post = Post::find($request->post);
        $data_array = $request->all();

        if($request->parent_id&&(int)$data_array['parent_id']>0) {
            $coment = Coment::find((int)$data_array['parent_id']);
            $data_array['level'] = ++$coment->level;
        }
        Coment::create($data_array);
        return redirect()->route('posts.show', $post)->withSuccess('User added');

    }

    public function update_from_ui(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('posts.show', $request->post)
                ->withErrors($validator)
                ->withInput();
        }
        $data_array = $request->all();
        if($request->parent_id&&(int)$data_array['parent_id']>0) {
            $coment = Coment::find((int)$data_array['parent_id']);
            $data_array['level'] = ++$coment->level;
        }
        $comment = Coment::find($id);
        $comment->text = str_replace('<p>&nbsp;</p>', '', $data_array['text']);
        $comment->save();
        return redirect()->route('posts.show', $request->post)->withSuccess('User added');

    }

    public function remove($id)
    {

        $coment = Coment::find($id);
        $coment->delete();
        return response()->json(['id' => $id]);
    }
}
