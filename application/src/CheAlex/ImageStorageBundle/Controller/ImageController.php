<?php

namespace CheAlex\ImageStorageBundle\Controller;

use CheAlex\ImageStorage\Application\Service\Image\TrackImageViewRequest;
use CheAlex\ImageStorage\Application\Service\Image\TrackImageViewService;
use CheAlex\ImageStorage\Domain\ViewDao\ImageViewDaoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ImageController
 * @package CheAlex\ImageStorageBundle\Controller
 */
class ImageController extends Controller
{
    /**
     * @param ImageViewDaoInterface $imageDao
     * @return Response
     */
    public function listAction(ImageViewDaoInterface $imageDao)
    {
        $images = $imageDao->getAllForView(10);

        return $this->render('CheAlexImageStorageBundle:Image:list.html.twig', [
            'images' => $images
        ]);
    }

    /**
     * @param Request $request
     * @param TrackImageViewService $appService
     * @return JsonResponse
     */
    public function trackViewAction(Request $request, TrackImageViewService $appService)
    {
        $userIdCookie = $this->getParameter('app_user_id_cookie');
        $userId       = $request->cookies->get($userIdCookie);
        $imageId      = (int) $request->query->get('imageId');

        $appRequest = new TrackImageViewRequest($imageId, $userId);
        $appResponse = $appService->execute($appRequest);

        return new JsonResponse(['result' => true]);
    }
}
