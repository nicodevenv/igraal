<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

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
        $postData = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($postData);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $serializedData = $this->get('serializer')->serialize($user, 'json');
        return new JsonResponse(json_decode($serializedData, true), Response::HTTP_OK);
    }

    /**
     * @Route("/user/{userId}", methods="GET", requirements={"userId"="\d+"}))
     *
     * @param $userId
     * @return JsonResponse
     */
    public function getAction($userId)
    {
        $userRepo = $this->getDoctrine()->getManager()->getRepository(User::class);

        $user = $userRepo->findOneBy(['id' => $userId]);

        $serializedData = $this->get('serializer')->serialize($user, 'json');
        return new JsonResponse(json_decode($serializedData, true), Response::HTTP_OK);
    }

    /**
     * @Route("/user/login", methods="POST"))
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function loginAction(Request $request)
    {
        $postData = json_decode($request->getContent(), true);

        $userRepo = $this->getDoctrine()->getManager()->getRepository(User::class);

        $user = $userRepo->findOneBy(['email' => $postData['email'], 'password' => $postData['password']]);

        $serializedData = $this->get('serializer')->serialize($user, 'json');
        return new JsonResponse(json_decode($serializedData, true), Response::HTTP_OK);
    }
}
