<?php

namespace App\MessageHandler;

use App\Message\SignupCompleted;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SignupConfirmationNotificationHandler implements MessageHandlerInterface
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(SignupCompleted $event)
    {
        /** @var Swift_Message $message */
        $message = $this->mailer->createMessage();
        $message
            ->setFrom('messenger-demo@example.de')
            ->setTo($event->getEmail())
            ->setSubject('Registrierung erfolgreich')
            ->setBody(sprintf(
                'Hallo %s %s, Deine Registrierung war erfolgreich!',
                $event->getFirstName(),
                $event->getLastName()
            ))
        ;
        $this->mailer->send($message);
    }
}
