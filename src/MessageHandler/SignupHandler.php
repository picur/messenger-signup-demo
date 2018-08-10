<?php

declare(strict_types = 1);

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\Signup;
use App\Message\SignupCompleted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SignupHandler implements MessageHandlerInterface
{
    private $entityManager;
    private $passwordEncoder;
    private $eventBus;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        MessageBusInterface $eventBus
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->eventBus = $eventBus;
    }

    public function __invoke(Signup $command): void
    {
        $user = new User($command->getEmail());
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $command->getPassword());
        $user->updatePassword($encodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $event = SignupCompleted::fromSignup($command);
        $this->eventBus->dispatch($event);
    }
}
