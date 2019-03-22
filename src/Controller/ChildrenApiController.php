<?php

namespace App\Controller;

use App\Entity\Sheet;
use App\Service\ChildManager;
use App\Service\NurseryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ChildrenApiController extends AbstractController
{
    /**
     * @Route("/api/nursery/{nurseryId}/children", name="api_children")
     *
     * Needed for client-side navigation after child list page loading
     *
     * @param string              $nurseryId
     * @param SerializerInterface $serializer
     *
     * @param ChildManager        $childManager
     * @param NurseryManager      $nurseryManager
     *
     * @return Response
     */
    public function apiChildrenAction(string $nurseryId, SerializerInterface $serializer, ChildManager $childManager, NurseryManager $nurseryManager)
    {
        $nursery = $nurseryManager->getById($nurseryId);
        return new Response($serializer->serialize($nursery->getChildren(), 'json', ['groups' => ['child_list']]),
            Response::HTTP_OK, ['Content-Type' => 'application/json']
        );
    }

    /**
     * @Route("/api/children/{childId}", name="api_child")
     *
     * Needed for client-side navigation after initial page load
     *
     * @param string              $childId
     * @param SerializerInterface $serializer
     * @param ChildManager        $childManager
     *
     * @return Response
     */
    public function apiChildAction(string $childId, SerializerInterface $serializer, ChildManager $childManager)
    {
        $child = $childManager->getChildById($childId);
        return new Response($serializer->serialize($child, 'json', ['groups' => ['child']]),
            Response::HTTP_OK, ['Content-type' => 'application/json']
        );
    }
    /**
     * @Route("/api/children/{childId}/sheets", name="api_child_sheets")
     *
     * Needed for client-side navigation after initial page load
     *
     * @param string              $childId
     * @param SerializerInterface $serializer
     * @param ChildManager        $childManager
     *
     * @return Response
     */
    public function apiChildSheetsAction(string $childId, SerializerInterface $serializer, ChildManager $childManager)
    {
        $child = $childManager->getChildById($childId);
        return new Response($serializer->serialize($child->getSheets(), 'json', ['groups' => ['history']]),
            Response::HTTP_OK, ['Content-type' => 'application/json']
        );
    }
}
