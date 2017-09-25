<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\ViewDao;

use CheAlex\ImageStorage\Domain\ViewDao\ImageViewDaoInterface;
use Doctrine\Common\Cache\CacheProvider;

/**
 * Class CachedImageViewDao
 * @package CheAlex\ImageStorage\Infrastructure\Domain\ViewDao
 */
class CachedImageViewDao implements ImageViewDaoInterface
{
    /**
     * @var ImageViewDaoInterface
     */
    private $imageViewDao;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * CachedImageViewDao constructor.
     * @param ImageViewDaoInterface $imageViewDao
     * @param CacheProvider         $cache
     */
    public function __construct(ImageViewDaoInterface $imageViewDao, CacheProvider $cache)
    {
        $this->imageViewDao = $imageViewDao;
        $this->cache        = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllForView(int $limit = 10): array
    {
        $cacheKey = 'images';

        $images = $this->cache->fetch($cacheKey);

        if (false === $images) {
            $images = $this->imageViewDao->getAllForView($limit);
            $this->cache->save($cacheKey, $images, 120);
        }

        return $images;
    }
}
