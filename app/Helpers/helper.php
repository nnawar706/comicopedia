<?php

use App\Models\Admin;
use App\Models\Cart;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

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

function notifyAdmins($role, $message, $model, $id, $type): void
{
    $admins = Admin::role($role)->get();

    foreach ($admins as $admin)
    {
        $admin->notify(new AdminNotification($message, $model, $id, $type));
    }
}

function updateSession($key, $value): void
{
    $prev_value = Session::get($key);

    $new_value = $prev_value + $value;

    Session::put($key, $new_value);
}

function calculatePrice(Cart $cart)
{
    $attribute_name = $cart->attribute->name;

    $price = $cart->volume->discount ? (($cart->volume->price - (($cart->volume->price * $cart->volume->discount) / 100)) * $cart->quantity) : ($cart->volume->price * $cart->quantity);

    if($attribute_name == 'Hardcover')
    {
        $price += (150 * $cart->quantity);
    }

    return $price;
}
