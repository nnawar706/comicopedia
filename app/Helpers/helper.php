<?php

use App\Models\Admin;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\File;

function saveFile($file, $path, $model, $field): void
{
    $file_name = time() . rand(100,999) . '.' . $file->getClientOriginalExtension();

    $file->move(public_path($path), $file_name);

    $model->$field = $path . $file_name;

    $model->save();
}

function deleteFile($path): void
{
    if(File::exists($path))
    {
        File::delete($path);
    }
}

function notifyAdmins($role, $message, $model, $id): void
{
    $admins = Admin::role($role)->get();

    foreach ($admins as $admin)
    {
        $admin->notify(new AdminNotification($message, $model, $id));
    }
}
