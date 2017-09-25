<?php

namespace CheAlex\ImageStorage\Application\Service\Image;

/**
 * Class SyncFileStorageRequest
 * @package CheAlex\ImageStorage\Application\Service\Image
 */
class SyncFileStorageRequest
{
    /**
     * @var \DateTimeImmutable
     */
    private $createAt;

    /**
     * SyncFileStorageRequest constructor.
     */
    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreateAt(): \DateTimeImmutable
    {
        return $this->createAt;
    }
}
