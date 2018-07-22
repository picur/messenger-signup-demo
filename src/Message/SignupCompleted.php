<?php

declare(strict_types = 1);

namespace App\Message;

use Symfony\Component\Validator\Constraints as Assert;

final class SignupCompleted
{
    /**
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public static function fromSignup(Signup $message): self
    {
        return new self($message->getFirstName(), $message->getLastName(), $message->getEmail());
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
