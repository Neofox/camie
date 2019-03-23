<?php

namespace App\Controller;

use App\Entity\Sheet;
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
            'initialState' => $serializer->serialize(
                ['child' => $child, 'user' => $user], 'json', ['groups' => ['child', 'user']])
        ]);
    }

    /**
     * @Route("/react/child/{childId}/history", name="react_child_history")
     * @param string              $childId
     *
     * @param ChildManager        $childManager
     * @param SerializerInterface $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function historyAction(string $childId, ChildManager $childManager, SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $child = $childManager->getChildById($childId);

        return $this->render('react/child.html.twig', [
            'initialState' => $serializer->serialize(
                ['child' => $child, 'user' => $user, 'sheets' => $child->getSheets()], 'json', ['groups' => ['child', 'user', 'history']])
        ]);
    }

    /**
     * @Route("/react/child/{childId}/sheet/{sheetId}/history", name="react_child_sheet_history")
     *
     * @param string              $childId
     * @param string              $sheetId
     * @param ChildManager        $childManager
     * @param SerializerInterface $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dailySheetAction(string $childId, string $sheetId, ChildManager $childManager, SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $child = $childManager->getChildById($childId);
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();

        return $this->render('react/child.html.twig', [
            'initialState' => $serializer->serialize(
                ['child' => $child, 'user' => $user, 'sheet' => $sheet], 'json', ['groups' => ['child', 'user', 'sheet']])
        ]);
    }
}
