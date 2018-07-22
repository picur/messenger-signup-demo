<?php

declare(strict_types = 1);

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\Signup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SignupHandler
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(Signup $message): void
    {
        $user = new User($message->getEmail());
        $user->updatePassword($this->passwordEncoder->encodePassword($user, $message->getPassword()));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
