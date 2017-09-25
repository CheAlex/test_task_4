<?php

namespace CheAlex\ImageStorage\Infrastructure\Domain\Service;

use CheAlex\ImageStorage\Domain\Service\IdentityGeneratorInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidIdentityGenerator
 * @package CheAlex\ImageStorage\Infrastructure\Domain\Service
 */
class UuidIdentityGenerator implements IdentityGeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return Uuid::uuid4()->toString();
    }
}
