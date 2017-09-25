<?php

namespace CheAlex\ImageStorageBundle\EventListener;

use CheAlex\ImageStorage\Domain\Service\IdentityGeneratorInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class UserIdSetter
 * @package CheAlex\ImageStorageBundle\EventListener
 */
class UserIdSetter
{
    /**
     * @var IdentityGeneratorInterface
     */
    private $identityGenerator;

    /**
     * @var string
     */
    private $userIdCookie;

    /**
     * @var string
     */
    private $userId;

    /**
     * UserIdSetter constructor.
     * @param IdentityGeneratorInterface $identityGenerator
     * @param string $userIdCookie
     */
    public function __construct(IdentityGeneratorInterface $identityGenerator, $userIdCookie)
    {
        $this->identityGenerator = $identityGenerator;
        $this->userIdCookie = $userIdCookie;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if (!$event->getRequest()->cookies->has($this->userIdCookie)) {
            $this->userId = $this->identityGenerator->generate();

            $event->getRequest()->cookies->set($this->userIdCookie, $this->userId);
        }
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if (null === $this->userId) {
            return;
        }

        $tomorrow = (new \DateTimeImmutable())->add(new \DateInterval('P1D'));
        $cookie = new Cookie($this->userIdCookie, $this->userId, $tomorrow);

        $event->getResponse()->headers->setCookie($cookie);
    }
}
