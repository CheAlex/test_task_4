<?php

namespace CheAlex\ImageStorage\Domain\Repository;

use CheAlex\ImageStorage\Domain\Model\ImageView;

/**
 * Interface ImageViewRepositoryInterface
 * @package CheAlex\ImageStorage\Domain\Repository
 */
interface ImageViewRepositoryInterface
{
    /**
     * @param ImageView $imageView
     */
    public function add(ImageView $imageView);
}
