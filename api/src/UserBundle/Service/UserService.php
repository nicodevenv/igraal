<?php
namespace UserBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

/**
 * Class UserService
 * @package UserBundle\Service
 */
class UserService {
    /** @var UserRepository */
    private $userRepo;

    /** @var SerializerInterface  */
    private $serializer;

    /** @var EntityManager  */
    private $entityManager;

    /**
     * UserService constructor.
     *
     * @param EntityManager       $entityManager
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManager $entityManager, SerializerInterface $serializer)
    {
        $this->userRepo = $entityManager->getRepository(User::class);
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function findUserByRequest(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepo->findOneBy(['email' => $data['email'], 'password' => $data['password']]);
        $userJson = $this->serializer->serialize($user, 'json');

        return json_decode($userJson, true);
    }

    /**
     * @param int $idUser
     *
     * @return array
     */
    public function findUserById($idUser)
    {
        $user = $this->userRepo->findOneBy(['id' => $idUser]);
        $userJson = $this->serializer->serialize($user, 'json');

        return json_decode($userJson, true);
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function saveUser($user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $userJson = $this->serializer->serialize($user, 'json');

        return json_decode($userJson, true);
    }
}
