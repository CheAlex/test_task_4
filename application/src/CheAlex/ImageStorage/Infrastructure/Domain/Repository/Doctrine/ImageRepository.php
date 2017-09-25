<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine;

use CheAlex\ImageStorage\Domain\Exception\ModelNotFoundException;
use CheAlex\ImageStorage\Domain\Model\Image;
use CheAlex\ImageStorage\Domain\Repository\ImageRepositoryInterface;

/**
 * Class ImageRepository
 * @package CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine
 */
class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    protected function getModelName(): string
    {
        return Image::class;
    }

    /**
     * {@inheritdoc}
     */
    public function add(Image $image)
    {
        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id): ?Image
    {
        return $this->getDoctrineRepository()->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function require (int $id): Image
    {
        $image = $this->find($id);

        if (null === $image) {
            ModelNotFoundException::fromClassNameAndIdentifier(Image::class, $id);
        }

        return $image;
    }

    /**
     * {@inheritdoc}
     */
    public function findByFileNames(array $fileNames): array
    {
        $images = $this->getDoctrineRepository()->findBy([
            'fileName' => $fileNames
        ]);
        return $images;
    }

    /**
     * {@inheritdoc}
     */
    public function findRandomActive(int $limit = 10): array
    {
        $images = $this->getDoctrineRepository()
            ->createQueryBuilder('image')
            ->addSelect('RAND() AS HIDDEN rand')
            ->andWhere('image.isActive = true')
            ->addOrderBy('rand')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return $images;
    }
}
