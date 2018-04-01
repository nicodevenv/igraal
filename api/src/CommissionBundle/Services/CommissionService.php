<?php

namespace CommissionBundle\Services;

use CommissionBundle\Entity\Commission;
use CommissionBundle\Repository\CommissionRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CommissionService
 * @package CommissionBundle\Services
 */
class CommissionService {
    /** @var EntityManager  */
    private $entityManager;

    /** @var SerializerInterface  */
    private $serializer;

    /** @var CommissionRepository */
    private $commissionRepository;

    /**
     * CommissionService constructor.
     *
     * @param EntityManager       $entityManager
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManager $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->commissionRepository = $this->entityManager->getRepository(Commission::class);
        $this->serializer = $serializer;
    }

    /**
     * @param int $idUser
     *
     * @return array
     */
    public function findUserCommissions($idUser)
    {
        $commissions = $this->commissionRepository->findBy(['idUser' => $idUser]);
        $serializedData = $this->serializer->serialize($commissions, 'json');

        return json_decode($serializedData, true);
    }
}