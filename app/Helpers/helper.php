<?php

use App\Models\Admin;
use App\Models\Cart;
use App\Models\SiteInformation;
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

function putSession($key, $value): void
{
    Session::put($key, $value);
}

function calculateDistance($lat1, $lon1): float|int
{
    $earthRadius = 6371;

    $site = SiteInformation::find(1);

    $lat2 = $site->latitude;
    $lon2 = $site->longitude;

    $radLat1 = deg2rad($lat1);
    $radLon1 = deg2rad($lon1);
    $radLat2 = deg2rad($lat2);
    $radLon2 = deg2rad($lon2);

    // Calculate the differences between the latitudes and longitudes
    $latDiff = $radLat2 - $radLat1;
    $lonDiff = $radLon2 - $radLon1;

    // Calculate the distance using the Haversine formula
    $a = sin($latDiff / 2) ** 2 + cos($radLat1) * cos($radLat2) * sin($lonDiff / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earthRadius * $c;
}

function calculatePrice(): float|int
{
    $cart_ids = Cart::where('session_id',Session::get('customer_unique_id'))->select('id')->get();

    $price = 0;

    foreach($cart_ids as $id)
    {
        $cart = Cart::find($id['id']);
        $attribute_name = $cart->attribute->name;

        $price += $cart->volume->discount ? (($cart->volume->price - (($cart->volume->price * $cart->volume->discount) / 100)) * $cart->quantity) : ($cart->volume->price * $cart->quantity);

        if ($attribute_name == 'Hardcover') {
            $price += (150 * $cart->quantity);
        }
    }

    return $price;
}
