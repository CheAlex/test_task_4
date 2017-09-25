<?php

namespace CheAlex\ImageStorage\Domain\Model;

/**
 * Class ImageView
 * @package CheAlex\ImageStorage\Domain\Model
 */
class ImageView
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @param Image              $image
     * @param string             $userId
     * @param \DateTimeImmutable $createdAt
     * @return self
     */
    public static function create(Image $image, string $userId, \DateTimeImmutable $createdAt)
    {
        $imageView = new self();

        $imageView->image     = $image;
        $imageView->userId    = $userId;
        $imageView->createdAt = $createdAt;

        return $imageView;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
