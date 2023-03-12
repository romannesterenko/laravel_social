<?php

namespace App\Http\Controllers;

use App\Http\Requests\SummernoteDeleteRequest;
use App\Http\Requests\SummernoteUploadRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class SummernoteController extends Controller
{
    public function upload(SummernoteUploadRequest $request)
    {
        $images = [];
        foreach ($request['files'] as $image) {
            //$img = $image->store('summernote');
            $img = $image->store('post_coments', 'public');
            $images[] = $img;
            $pic = Image::make('storage/' . $img);
            $width = $pic->width();
            if($width > 800) {
                $pic->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $pic->save();
        }
        return $images;
    }

    public function delete(SummernoteDeleteRequest $request)
    {
        return Storage::delete($request['file']);
    }
}
