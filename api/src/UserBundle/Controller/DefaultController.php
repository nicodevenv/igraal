<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;
use UserBundle\Service\UserService;

class DefaultController extends Controller
{
    /**
     * @Route("/user/register", methods="POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function registerAction(Request $request)
    {
        /** @var UserService $userService */
        $userService = $this->container->get('service.user');

        $postData = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($postData);
        $userData = $userService->saveUser($user);

        return new JsonResponse($userData, Response::HTTP_OK);
    }

    /**
     * @Route("/user/{userId}", methods="GET", requirements={"userId"="\d+"}))
     *
     * @param $userId
     * @return JsonResponse
     */
    public function getAction($userId)
    {
        /** @var UserService $userService */
        $userService = $this->container->get('service.user');
        $userData = $userService->findUserById($userId);

        return new JsonResponse($userData, Response::HTTP_OK);
    }

    /**
     * @Route("/user/login", methods="POST"))
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function loginAction(Request $request)
    {
        /** @var UserService $userService */
        $userService = $this->container->get('service.user');

        $data = json_decode($request->getContent(), true);
        $userData = $userService->findUserByEmailPassword($data['email'], $data['password']);

        return new JsonResponse($userData, Response::HTTP_OK);
    }
}
