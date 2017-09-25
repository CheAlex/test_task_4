<?php

namespace CheAlex\ImageStorage\Application\Service\Image;

/**
 * Class TrackImageViewRequest
 * @package CheAlex\ImageStorage\Application\Service\Image
 */
class TrackImageViewRequest
{
    /**
     * @var \DateTimeImmutable
     */
    private $createAt;

    /**
     * @var int
     */
    private $imageId;

    /**
     * @var string
     */
    private $userId;

    /**
     * TrackImageViewRequest constructor.
     * @param int    $imageId
     * @param string $userId
     */
    public function __construct(int $imageId, string $userId)
    {
        $this->imageId  = $imageId;
        $this->userId   = $userId;
        $this->createAt = new \DateTimeImmutable();
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreateAt(): \DateTimeImmutable
    {
        return $this->createAt;
    }

    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->imageId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
