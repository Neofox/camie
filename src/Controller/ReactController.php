<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\ChildManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReactController extends AbstractController
{
    /**
     * @Route("/react", name="react")
     * @param SerializerInterface $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $children = $user->getChildren();

        return $this->render('react/index.html.twig', [
            // We pass an array as props
            'initialState' => $serializer->serialize(
                ['children' => $children, 'user' => $user], 'json', ['groups' => ['child_list', 'user']])
        ]);
    }

    /**
     * @Route("/react/child/{childId}", name="react_child")
     * @param string              $childId
     *
     * @param ChildManager        $childManager
     * @param SerializerInterface $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function childAction(string $childId, ChildManager $childManager, SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $child = $childManager->getChildById($childId);

        if (!$child) {
            throw $this->createNotFoundException('The child does not exist');
        }
        return $this->render('react/child.html.twig', [
            // A JSON string also works
            'initialState' => $serializer->serialize(
                ['child' => $child, 'user' => $user], 'json', ['groups' => ['child', 'user']])
        ]);
    }
}
