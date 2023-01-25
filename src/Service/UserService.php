<?php


namespace App\Service;


use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserService
{
    private UserRepository $userRepository;
    private ManagerRegistry $doctrine;

    public function __construct(UserRepository $userRepository, ManagerRegistry $doctrine)
    {
        $this->userRepository = $userRepository;
        $this->doctrine = $doctrine;
    }

    private function getUserById(User $user)
    {
        return $this->userRepository->findOneBy(['id' => $user->getId(), 'status' => User::STATUS_ACTIVE]);
    }

    public function save(User $user): void
    {
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
    }

    public function findUserByEmailAndName(string $email, string $name): ?object
    {
        return $this->userRepository->findOneBy(["email" => $email, 'userName' => $name]);
    }
}