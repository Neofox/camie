<?php

namespace App\Controller\Child;

use App\Entity\User;
use App\Serializer\Normalizer\ChildNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ChildListController extends AbstractController
{
    /**
     * @Route("/child/list", name="child_list")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SerializerInterface $serializer)
    {

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $children = $user->getChildren();

        $json = $serializer->serialize($children, 'json', ['groups' => ['child_list']]);

        return $this->render('child_list/index.html.twig', ['children' => $json]);
    }
}
