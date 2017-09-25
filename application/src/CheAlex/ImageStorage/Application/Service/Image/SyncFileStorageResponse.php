<?php

namespace CheAlex\ImageStorage\Application\Service\Image;

/**
 * Class SyncFileStorageResponse
 * @package CheAlex\ImageStorage\Application\Service\Image
 */
class SyncFileStorageResponse
{
    /**
     * @var int
     */
    private $countNewImages;

    /**
     * SyncFileStorageResponse constructor.
     * @param int $countNewImages
     */
    public function __construct(int $countNewImages)
    {
        $this->countNewImages = $countNewImages;
    }

    /**
     * @return int
     */
    public function getCountNewImages(): int
    {
        return $this->countNewImages;
    }
}
