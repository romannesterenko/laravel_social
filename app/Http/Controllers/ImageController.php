<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Image as Img;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use View;

class ImageController extends Controller
{
    public function index(){
        $images = Img::orderBy('id', 'desc')->paginate(30);
        return view('admin.images.index', compact('images'));
    }
    public function store(Request $request){
        if(is_array($request->file('picture'))&&count($request->file('picture'))>0) {
            $images = $request->file('picture');
            foreach ($images as $image){
                $imageResize = Image::make($image)->encode('webp');
                if ($imageResize->width() > 510){
                    $imageResize->resize(510, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $destinationPath = storage_path('app/public/u_images').'/'.time().'.webp';
                $imageResize->save($destinationPath);
                $base = basename($destinationPath);
                $image_e = Img::create([
                    'url' => $base,
                    'entity' => $request->entity,
                    'post_id' => $request->post,
                    'user_id' => $request->user,
                ]);
                if($image_e) {
                    $config[] = [
                        'key' => $image_e->id,
                        'caption' => $base,
                        'size' => $image->getSize(),
                        'downloadUrl' => $image_e->url, // the url to download the file
                        'url' => '/delete_image', // server api to delete the file based on key
                    ];
                }
                return response()->json(['initialPreview' => asset('storage/u_images/'.$base), 'initialPreviewConfig' => $config, 'initialPreviewAsData' => false]);
            }
        }

    }
    public function store_ui(Request $request){
        if($request->file('picture')) {
            $image = $request->file('picture');
            //foreach ($images as $image){
                $imageResize = Image::make($image)->encode('webp');
                if ($imageResize->width() > 510){
                    $imageResize->resize(510, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $destinationPath = storage_path('app/public/u_images').'/'.time().'_'.$request->user.'_'.$request->number.'.webp';
                $imageResize->save($destinationPath);
                $base = basename($destinationPath);
                $image_e = Img::create([
                    'url' => $base,
                    'entity' => $request->entity,
                    'post_id' => $request->post,
                    'user_id' => $request->user,
                ]);
            //}
        }
        if($request->post) {
            $post = Post::find($request->post);
            echo View::make("components.post-images", ['post' => $post])->render();
        } else {
            echo View::make("components.unused-images")->render();
        }
    }
    public function delete(Request $request){

        $image = Img::find($request->key);
        $old = $image->url;
        if ($old) {
            Storage::disk('public')->delete('u_images/' . $old);
        }
        $image->delete();
        return response()->json([]);
    }
    public function delete_ui(Request $request){
        $image = Img::find($request->key);
        $old = $image->url;
        if ($old) {
            Storage::disk('public')->delete('u_images/' . $old);
        }
        $image->delete();
        if($request->by_post){
            $post = Post::find($request->post);
            echo View::make("components.post-images", ['post' => $post])->render();
        }else{
            echo View::make("components.unused-images")->render();
        }
    }
}
