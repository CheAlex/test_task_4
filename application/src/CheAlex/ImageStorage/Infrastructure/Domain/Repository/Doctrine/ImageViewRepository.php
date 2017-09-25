<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine;

use CheAlex\ImageStorage\Domain\Model\ImageView;
use CheAlex\ImageStorage\Domain\Repository\ImageViewRepositoryInterface;

/**
 * Class ImageViewRepository
 * @package CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine
 */
class ImageViewRepository extends BaseRepository implements ImageViewRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    protected function getModelName(): string
    {
        return ImageView::class;
    }

    /**
     * {@inheritdoc}
     */
    public function add(ImageView $imageView)
    {
        $this->getEntityManager()->persist($imageView);
        $this->getEntityManager()->flush();
    }
}
