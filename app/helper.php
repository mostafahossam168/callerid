<?php

use Illuminate\Support\Facades\Storage;

function store_file($file, $path)
{
    $name = time() . $file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}
function delete_file($file)
{
    if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
        unlink('uploads/' . $file);
    }
}
function display_file($name)
{
    return asset('uploads') . '/' . $name;
}
function deviceId()
{
    return request()->header('X-DEVICE-ID');
}



function countryCode()
{
    return [
        "20",  // Egypt
        "966", // Saudi Arabia
        "971", // UAE
        "1",   // USA and Canada
        "44",  // United Kingdom
        "33",  // France
        "49",  // Germany
        "39",  // Italy
        "34",  // Spain
        "61",  // Australia
        "81",  // Japan
        "86",  // China
        "91",  // India
        "52",  // Mexico
        "55",  // Brazil
        "61",  // Australia
        "63",  // Philippines
        "64",  // New Zealand
        "351", // Portugal
        "966", // Saudi Arabia
        "82",  // South Korea
        "7",   // Russia
        "84",  // Vietnam
        "56",  // Chile
        "90",  // Turkey
        "971", // UAE
        "380", // Ukraine
        "972", // Israel
        "377", // Monaco
        "380", // Ukraine
        "212", // Morocco
        "213"  // Algeria
    ];
}