<?php

namespace CheAlex\ImageStorage\Domain\Model;

/**
 * Class Image
 * @package CheAlex\ImageStorage\Domain\Model
 */
class Image
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @param string             $fileName
     * @param \DateTimeImmutable $createdAt
     * @return Image
     */
    public static function createActive(string $fileName, \DateTimeImmutable $createdAt)
    {
        $image = new self();

        $image->fileName  = $fileName;
        $image->isActive  = true;
        $image->createdAt = $createdAt;

        return $image;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
