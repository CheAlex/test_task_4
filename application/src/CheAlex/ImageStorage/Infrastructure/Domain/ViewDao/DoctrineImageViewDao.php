<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\ViewDao;

use CheAlex\ImageStorage\Application\Service\ImageStorage;
use CheAlex\ImageStorage\Domain\Repository\ImageRepositoryInterface;
use CheAlex\ImageStorage\Domain\ViewDao\ImageViewDaoInterface;
use CheAlex\ImageStorage\Domain\ViewDto\ImageDto;

/**
 * Class DoctrineImageViewDao
 * @package CheAlex\ImageStorage\Infrastructure\Domain\ViewDao
 */
class DoctrineImageViewDao implements ImageViewDaoInterface
{
    /**
     * @var ImageStorage
     */
    private $imageStorage;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * DoctrineImageViewDao constructor.
     * @param ImageStorage             $imageStorage
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ImageStorage $imageStorage, ImageRepositoryInterface $imageRepository)
    {
        $this->imageStorage    = $imageStorage;
        $this->imageRepository = $imageRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllForView(int $limit = 10): array
    {
        $imageViewDtos = [];
        $images = $this->imageRepository->findRandomActive($limit);

        foreach ($images as $image) {
            $imageViewDtos[] = new ImageDto(
                $image->getId(),
                $image->getFileName(),
                $this->imageStorage->getImageUrl($image)
            );
        }

        return $imageViewDtos;
    }
}
