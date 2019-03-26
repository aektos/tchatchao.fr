<?php
// src/Service/Image.php
namespace App\Service;

use Gregwar\Image\Image as ImageTool;

/**
 * Class Image
 * @package App\Service
 */
class Image
{
    /**
     * @var null|string
     */
    private $publicDir = null;
    /**
     * @var null|string
     */
    private $publicCacheDir = null;
    /**
     * @var null|string
     */
    private $cacheDir = null;


    public function __construct($publicDir, $publicCacheDir, $cacheDir)
    {
        $this->publicDir = $publicDir;
        $this->publicCacheDir = $publicCacheDir;
        $this->cacheDir = $cacheDir;
    }

    public function resize(String $imagePath, int $width, int $height)
    {
        $pathInfo = pathinfo($imagePath);
        $filenameExt = $pathInfo['filename'] . '_' . $width . 'X' . $height .'.'. $pathInfo['extension'];

        $imagePath = $this->publicDir . $imagePath;
        $cacheImagePath = $this->cacheDir . $filenameExt;
        $cacheImagePublic = $this->publicCacheDir . $filenameExt;

        if (@file_exists($imagePath) && @file_exists($cacheImagePath)) {

            return $cacheImagePublic;
        } else if (!@file_exists($cacheImagePath)) {

            @chmod($imagePath, 0755);
            @chmod($cacheImagePath, 0755);
            ImageTool::open($imagePath)
                ->zoomCrop($width, $height, "#fff", "center", "center")
                ->save($cacheImagePath);

            return $cacheImagePublic;
        } else {
//            throw \Exception('File not found');
            return "http://via.placeholder.com/" . $width . 'X' . $height;
        }
    }


}