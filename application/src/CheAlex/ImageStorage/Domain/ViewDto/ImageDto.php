<?php

namespace CheAlex\ImageStorage\Domain\ViewDto;

/**
 * Class ImageDto
 * @package CheAlex\ImageStorage\Domain\ViewDto
 */
class ImageDto
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
     * @var string
     */
    private $url;

    /**
     * ImageDto constructor.
     * @param int    $id
     * @param string $fileName
     * @param string $url
     */
    public function __construct(int $id, string $fileName, string $url)
    {
        $this->id       = $id;
        $this->fileName = $fileName;
        $this->url      = $url;
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
