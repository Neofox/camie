<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Service\ChildManager;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile")
     * @param UserManager  $userManager
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserManager $userManager, ChildManager $childManager)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $subUser = $userManager->getGuardianOrNurse($user);
        $children = $childManager->retrieveChildrenOfNursery($user->getNursery());

        return $this->render('user_profile/index.html.twig', ['user' => $subUser, 'children' => $children]);
    }

    /**
     * @Route("/user/profile/ajax", name="user_profile_ajax")
     * @param string      $childId
     * @param UserManager $userManager
     */
    public function ajax(string $childId, UserManager $userManager)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('ROLE_NURSE', $user, 'User tried to modify assign child but is not ROLE_NURSE');

        $nurse = $userManager->getGuardianOrNurse($user);
        $userManager->assignChildToNurse($childId, $nurse);

    }
}
