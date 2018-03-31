<?php

namespace CommissionBundle\Controller;

use CommissionBundle\Entity\Commission;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/commissions/{idUser}", methods="GET", requirements={"idUser"="\d+"}))
     *
     * @param $idUser
     * @return JsonResponse
     */
    public function getUserCommissionAction($idUser)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(Commission::class);

        $user = $repo->findBy(['idUser' => $idUser]);

        $serializedData = $this->get('serializer')->serialize($user, 'json');
        return new JsonResponse(json_decode($serializedData, true), Response::HTTP_OK);
    }
}
