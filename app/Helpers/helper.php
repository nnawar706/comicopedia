<?php

function saveFile($file, $path, $model, $field)
{
    $file_name = time() . rand(100,999) . '.' . $file->getClientOriginalExtension();
    
    $file->move(public_path($path), $image_name);
    
    $model->$field = $path . $file_name;
    
    $model->save();
}

function deleteFile($path)
{
    if(File::exists($path))
    {
        File::delete($path);
    }
}