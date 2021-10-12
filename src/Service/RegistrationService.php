<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Modifier\User\UserModifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserModifier
     */
    private UserModifier $userModifier;

    /**
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     * @param UserModifier $userModifier
     */
    public function __construct
    (
        UserPasswordHasherInterface $passwordEncoder,
        EntityManagerInterface $entityManager,
        UserModifier $userModifier
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        $this->userModifier = $userModifier;
    }

    /**
     * @param User $user
     */
    public function handleUserRegistration(User $user): void
    {
        $newPassword = $this->passwordEncoder->hashPassword($user, $user->getPassword());
        $modifiedUser = $this->userModifier->modify($user, $newPassword, User::DEFAULT_USER_ROLES);
        $this->entityManager->persist($modifiedUser);
        $this->entityManager->flush();
    }
}
