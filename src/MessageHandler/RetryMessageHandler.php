<?php

declare(strict_types = 1);

namespace App\MessageHandler;

use App\Message\RetryMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RetryMessageHandler implements MessageHandlerInterface
{
    private $serializer;
    private $messageBus;

    public function __construct(SerializerInterface $serializer, MessageBusInterface $retryBus)
    {
        $this->serializer = $serializer;
        $this->messageBus = $retryBus;
    }

    public function __invoke(RetryMessage $message)
    {
        $original = $this->serializer->deserialize($message->getOriginal(), $message->getType(), 'json');

        $this->messageBus->dispatch($original);
    }
}
