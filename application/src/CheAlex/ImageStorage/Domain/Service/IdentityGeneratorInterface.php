<?php

namespace CheAlex\ImageStorage\Domain\Service;

/**
 * Interface IdentityGeneratorInterface
 * @package CheAlex\ImageStorage\Domain\Service
 */
interface IdentityGeneratorInterface
{
    /**
     * @return string
     */
    public function generate();
}
