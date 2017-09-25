<?php

namespace CheAlex\ImageStorage\Application\Service\Image;

use CheAlex\ImageStorage\Domain\Model\Image;
use CheAlex\ImageStorage\Domain\Repository\ImageRepositoryInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class SyncFileStorageService
 * @package CheAlex\ImageStorage\Application\Service\Image
 */
class SyncFileStorageService
{
    /**
     * @var string
     */
    private $storagePath;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var int
     */
    private $countPerRequest;

    /**
     * SyncFileStorageService constructor.
     * @param string                   $storagePath
     * @param ImageRepositoryInterface $imageRepository
     * @param int                      $countPerRequest
     */
    public function __construct(
        string                   $storagePath,
        ImageRepositoryInterface $imageRepository,
        int                      $countPerRequest = 10
    ) {
        $this->storagePath     = $storagePath;
        $this->imageRepository = $imageRepository;
        $this->countPerRequest = $countPerRequest;
    }

    /**
     * @param SyncFileStorageRequest $request
     * @return SyncFileStorageResponse
     */
    public function execute(SyncFileStorageRequest $request): SyncFileStorageResponse
    {
        $countNewImages = 0;

        foreach ($this->getImageFileNames() as $imageFileNames) {
            $existImages = $this->imageRepository->findByFileNames($imageFileNames);

            $existFileNames = [];

            foreach ($existImages as $existImage) {
                $existFileNames[] = $existImage->getFileName();
            }

            $notExistFileNames = array_diff($imageFileNames, $existFileNames);

            $this->addImages($notExistFileNames, $request->getCreateAt());

            $countNewImages += count($notExistFileNames);
        }

        return new SyncFileStorageResponse($countNewImages);
    }

    /**
     * @return \Generator
     */
    private function getImageFileNames(): \Generator
    {
        $finder = new Finder();
        $finder->files()->in($this->storagePath);

        $imageFiles = [];

        foreach ($finder as $file) {
            $imageFiles[] = $file->getRelativePathname();

            if ($this->countPerRequest === count($imageFiles)) {
                yield $imageFiles;
                $imageFiles = [];
            }
        }

        if ($imageFiles) {
            yield $imageFiles;
        }
    }

    /**
     * @param string[] $imagesFileNames
     * @param \DateTimeImmutable $createdAt
     */
    private function addImages(array $imagesFileNames, \DateTimeImmutable $createdAt)
    {
        foreach ($imagesFileNames as $imageFileName) {
            $image = Image::createActive($imageFileName, $createdAt);
            $this->imageRepository->add($image);
        }
    }
}
