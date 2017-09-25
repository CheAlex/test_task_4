<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 * @package CheAlex\ImageStorage\Infrastructure\Domain\Repository\Doctrine
 */
abstract class BaseRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * BaseRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    abstract protected function getModelName(): string;

    /**
     * @return EntityRepository
     */
    protected function getDoctrineRepository(): EntityRepository
    {
        return $this->entityManager->getRepository($this->getModelName());
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
