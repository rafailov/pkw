<?php

namespace App\Classes;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Log;

class ImageProccessing
{
    public static function storeNewImage($file, $pathBig = null, $pathSmall = null, $newSize = array(100, 100))
    {

//        $fileName = '/' . time() . '.' . $file->getClientOriginalExtension();
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $widthSize = $newSize[0];
        $heightSize = $newSize[1];

        try {
            if ($pathBig != null) {
                Image::make($file->getRealPath())->save($pathBig . $fileName);
            }
            if ($pathSmall != null) {
                Image::make($file->getRealPath())->resize($widthSize, $heightSize)->save($pathSmall . $fileName);
            }
        } catch (\Exception $ex) {


            Log::error($ex);
            return false;
        }


        return $fileName;
    }

    public static function deleteOldImage($fileName, $pathBig, $pathSmall = null)
    {

        try {
            if ($pathBig != null) {
                if (File::exists($pathBig . $fileName)) {
                    File::delete($pathBig . $fileName);
                }
            }

            if ($pathSmall != null) {
                if (File::exists($pathSmall . $fileName)) {
                    File::delete($pathSmall . $fileName);
                }
            }
        } catch
        (\Exception $ex) {
            Log::error($ex);
            return false;
        }
        return true;

    }


}