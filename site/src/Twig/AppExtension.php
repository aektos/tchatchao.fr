<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Service\Image;

/**
 * Class AppExtension
 * @package App\Twig
 */
class AppExtension extends AbstractExtension
{
    /**
     * @var Image
     */
    private $image;

    public function __construct(Image $image) {
        $this->image = $image;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('resize', [$this, 'resize']),
        ];
    }

    /**
     * Resize image
     *
     * @param String $imagePath
     * @param int $width
     * @param int $height
     * @return string
     */
    public function resize(String $imagePath, int $width, int $height)
    {
        return $this->image->resize($imagePath, $width, $height);
    }
}