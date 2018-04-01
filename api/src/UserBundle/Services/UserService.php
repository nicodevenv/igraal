<?php
namespace UserBundle\Services;

use Doctrine\ORM\EntityManager;
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
        $this->entityManager = $entityManager;
        $this->userRepo = $this->entityManager->getRepository(User::class);
        $this->serializer = $serializer;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return array
     */
    public function findUserByEmailPassword($email, $password)
    {
        $user = $this->userRepo->findOneBy(['email' => $email, 'password' => $password]);
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
