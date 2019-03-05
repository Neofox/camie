<?php

namespace App\Controller\Child;

use App\Entity\User;
use App\Service\ChildManager;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChildCreateController extends AbstractController
{
    /**
     * @Route("/child/create", name="child_create")
     *
     * @param Request      $request
     * @param ChildManager $childManager
     * @param UserManager  $userManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, ChildManager $childManager, UserManager $userManager)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($request->getMethod() === 'POST'){
            $formData = $request->request->all();
            $data = $this->sanitizeFormDate($formData);
            $child = $childManager->createChild($formData, $user->getNursery());
            $userManager->createOrAssignGuardian($data, $child);

            return $this->render('child_create/index.html.twig', ['created' => true]);
        }

        return $this->render('child_create/index.html.twig', ['created' => false]);
    }

    private function sanitizeFormDate(array $formData): array
    {
        $sanitazedData = [];
        if(!empty($formData['user'])) {
            $fullName = explode(' ', $formData['user']);
            $sanitazedData['firstname'] = $fullName[0];
            $sanitazedData['lastname'] = ($fullName[1] ?? '');
        }

        return array_merge($formData, $sanitazedData);
    }
}
