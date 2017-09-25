<?php

namespace CheAlex\ImageStorage\Domain\Repository;

use CheAlex\ImageStorage\Domain\Exception\ModelNotFoundException;
use CheAlex\ImageStorage\Domain\Model\Image;

/**
 * Interface ImageRepositoryInterface
 * @package CheAlex\ImageStorage\Domain\Repository
 */
interface ImageRepositoryInterface
{
    /**
     * @param Image $image
     */
    public function add(Image $image);

    /**
     * @param int $id
     * @return Image|null
     */
    public function find(int $id): ?Image;

    /**
     * @param int $id
     * @return Image
     * @throws ModelNotFoundException
     */
    public function require(int $id): Image;

    /**
     * @param string[] $fileNames
     * @return Image[]
     */
    public function findByFileNames(array $fileNames): array;

    /**
     * @param int $limit
     * @return Image[]
     */
    public function findRandomActive(int $limit = 10): array;
}
