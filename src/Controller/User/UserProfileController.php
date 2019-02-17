<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Service\ChildManager;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile")
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ChildManager $childManager)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $children = $childManager->retrieveChildrenOfNursery($user->getNursery());

        return $this->render('user_profile/index.html.twig', ['user' => $user, 'children' => $children]);
    }

    /**
     * @Route("/user/profile/ajax", name="user_profile_ajax")
     * @param UserManager $userManager
     * @param Request     $request
     *
     * @return mixed
     * @internal param string $childId
     */
    public function ajax(UserManager $userManager, Request $request)
    {
        $childId = $request->request->get('childId');
        $action = $request->request->get('action');

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('ROLE_NURSE', $user, 'User tried to modify assign child but is not ROLE_NURSE');

        if ($action === 'assign') {
            $userManager->assignChildToNurse($childId, $user);
        }
        if ($action === 'unassign') {
            $userManager->unAssignChildToNurse($childId, $user);
        }

        // TODO: respond something?
        return new JsonResponse();
    }
}
