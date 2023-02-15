<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService {
    public static function upload($imageFile, $folderName) {
        if(is_array($imageFile)) {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }
        $fileName = uniqid(rand().'_');
        $extension = $file->extension();
        $fileNameToStore = $fileName. '.' . $extension;
        if($folderName === 'images') {
            $resizedImage = InterventionImage::make($file)->resize(null, 810, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();
        } else {
            $resizedImage = InterventionImage::make($file)->resize(50, null, function($constraint) {
                $constraint->aspectRatio();
            })->encode();
        }
        Storage::put('public/'. $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
}
