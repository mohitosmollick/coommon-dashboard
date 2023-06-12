<?php

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class FileHandler
{

    static function ServerURL($fileName)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . '/' . $fileName;
    }

    static function nameGenerate($slug, $RequestImage)
    {
        $currentDate = Carbon::now()->toDateString();
        return $slug . '-' . $currentDate . '-' . uniqid() . '.' . $RequestImage->getClientOriginalExtension();
    }

    static function imageResize($RequestImage, $width, $height, $image_path)
    {
        return Image::make($RequestImage)->resize($width, $height)->save($image_path);
    }

    static function fileDelete($data, $path)
    {
        $imageName = explode('/', $data)[5];
        return unlink($path . $imageName);
    }


}
