<?php

declare(strict_types = 1);

namespace App\Middleware;

use App\Message\RetryMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class RetryQueueMiddleware implements MiddlewareInterface
{
    private $logger;
    private $retryBus;
    private $serializer;

    public function __construct(
        LoggerInterface $logger,
        MessageBusInterface $retryBus,
        SerializerInterface $serializer
    ) {
        $this->logger = $logger;
        $this->retryBus = $retryBus;
        $this->serializer = $serializer;
    }

    public function handle($message, callable $next)
    {
        try {
            return $next($message);
        } catch (\Throwable $error) {
            $this->logger->error($error->getMessage(), ['exception' => $error]);

            $retryMessage = new RetryMessage($this->serializer->serialize($message, 'json'), get_class($message));
            $this->retryBus->dispatch($retryMessage);
        }

        return null;
    }
}
