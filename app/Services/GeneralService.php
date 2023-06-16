<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralService{

    public function uploadImage(Request $request, $path)
    {
        $photo = $request->file('image');

        $photo_file = time() . rand(100,99999) . '.' . $photo->getClientOriginalExtension();

        $photo->move(public_path($path), $photo_file);

        return $photo_file;
    }

    public function deleteFile($path)
    {
        if(File::exists($path))
        {
            File::delete($path);
        }
    }
}