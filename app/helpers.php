<?php

function saveImage($photo, $folder)
{
    $name_gen = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
    $photo->move('uploads/' . $folder, $name_gen);
    $save_url = 'uploads/' . $folder . '/' . $name_gen;
    return $save_url;
}

function getLanguage()
{
    return session()->get('language') == 'ar' ? 'ar' : 'en';
}
