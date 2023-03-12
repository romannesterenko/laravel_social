<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Storage;

class Image
{
    public static function process_file($entity, $field_name, $request)
    {
        $file = $request->file($field_name);
        if ($file!==null) {
            $old = $entity->$field_name;
            if ($old) {
                Storage::disk('public')->delete($field_name.'/' . $old);
            }
            $path = $file->store($field_name, 'public');
            return basename($path);
        }
        return false;
    }
}
