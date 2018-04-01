<?php

namespace CommissionBundle\Controller;

use CommissionBundle\Services\CommissionService;
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
        /** @var CommissionService $commissionService */
        $commissionService = $this->container->get('service.commission');
        $commissions = $commissionService->findUserCommissions($idUser);

        return new JsonResponse($commissions, Response::HTTP_OK);
    }
}
