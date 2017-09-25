<?php

namespace CheAlex\ImageStorage\Domain\ViewDao;

use CheAlex\ImageStorage\Domain\ViewDto\ImageDto;

/**
 * Interface ImageViewDaoInterface
 * @package CheAlex\ImageStorage\Domain\ViewDao
 */
interface ImageViewDaoInterface
{
    /**
     * @param int $limit
     * @return ImageDto[]
     */
    public function getAllForView(int $limit = 10): array;
}
