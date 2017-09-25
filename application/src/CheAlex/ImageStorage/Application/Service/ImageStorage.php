<?php

namespace CheAlex\ImageStorage\Application\Service;

use CheAlex\ImageStorage\Domain\Model\Image;

/**
 * Class ImageStorage
 * @package CheAlex\ImageStorage\Application\Service
 */
class ImageStorage
{
    /**
     * @var string
     */
    private $webPath;

    /**
     * ImageStorage constructor.
     * @param string $webPath
     */
    public function __construct(string $webPath)
    {
        $this->webPath = $webPath;
    }

    /**
     * @param Image $image
     * @return string
     */
    public function getImageUrl(Image $image): string
    {
        return $this->webPath . '/' . $image->getFileName();
    }
}
