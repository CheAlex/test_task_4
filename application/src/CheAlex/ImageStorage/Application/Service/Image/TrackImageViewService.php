<?php

namespace CheAlex\ImageStorage\Application\Service\Image;

use CheAlex\ImageStorage\Domain\Model\ImageView;
use CheAlex\ImageStorage\Domain\Repository\ImageRepositoryInterface;
use CheAlex\ImageStorage\Domain\Repository\ImageViewRepositoryInterface;

/**
 * Class TrackImageViewService
 * @package CheAlex\ImageStorage\Application\Service\Image
 */
class TrackImageViewService
{
    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * @var ImageViewRepositoryInterface
     */
    private $imageViewRepository;

    /**
     * TrackImageViewService constructor.
     * @param ImageRepositoryInterface     $imageRepository
     * @param ImageViewRepositoryInterface $imageViewRepository
     */
    public function __construct(
        ImageRepositoryInterface     $imageRepository,
        ImageViewRepositoryInterface $imageViewRepository
    ) {
        $this->imageRepository     = $imageRepository;
        $this->imageViewRepository = $imageViewRepository;
    }

    /**
     * @param TrackImageViewRequest $request
     * @return TrackImageViewResponse
     */
    public function execute(TrackImageViewRequest $request): TrackImageViewResponse
    {
        $image     = $this->imageRepository->require($request->getImageId());
        $imageView = ImageView::create($image, $request->getUserId(), $request->getCreateAt());

        $this->imageViewRepository->add($imageView);

        return new TrackImageViewResponse();
    }
}
