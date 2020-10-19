<?php

namespace src\helpers;

class ImageHelper
{
    public static function extractImage(array $file, int $width, int $height, string $path): string
    {
        $filename = $file['name'];
        list($sourceWidth, $sourceHeight) = getimagesize($file['tmp_name']);
        $ratio = $sourceWidth / $sourceHeight;
        $newWidth = $width;
        $newHeight = $newWidth / $ratio;

        if ($newHeight < $height) {
            $newHeight = $height;
            $newWidth = $newHeight * $ratio;
        }

        $x = $width - $newWidth;
        $y = $height - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($width, $height);
        switch ($file['type']) {
            case 'image/jpg':
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'image/bmp':
                $image = imagecreatefrombmp($file['tmp_name']);
                break;
        }        
        
        imagepalettetotruecolor($finalImage);
        imagealphablending($finalImage, false);
        imagesavealpha($finalImage, true);
        imagecopyresampled(
            $finalImage, $image, $x, $y, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight
        );

        $filename = md5($filename . time() . rand(0, 99999)) . '.webp';
        imagewebp($finalImage, "$path/$filename");
        imagedestroy($finalImage);

        return $filename;
    }

    public static function extractPostImage(array $file, int $width, int $height, string $path): string
    {
        $filename = $file['name'];
        list($sourceWidth, $sourceHeight) = getimagesize($file['tmp_name']);
        $ratio = $sourceWidth / $sourceHeight;
        $newWidth = $width;
        $newHeight = $height;
        $ratioMax = $width / $height;

        if ($ratioMax > $ratio) {
            $newWidth = $newHeight * $ratio;
        } else {
            $newHeight = $newWidth / $ratio;
        }

        $finalImage = imagecreatetruecolor($newWidth, $newHeight);
        switch ($file['type']) {
            case 'image/jpg':
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'image/bmp':
                $image = imagecreatefrombmp($file['tmp_name']);
                break;
        }        
        
        imagepalettetotruecolor($finalImage);
        imagealphablending($finalImage, false);
        imagesavealpha($finalImage, true);
        imagecopyresampled(
            $finalImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight
        );

        $filename = md5($filename . time() . rand(0, 99999)) . '.webp';
        imagewebp($finalImage, "$path/$filename");
        imagedestroy($finalImage);

        return $filename;
    }
}