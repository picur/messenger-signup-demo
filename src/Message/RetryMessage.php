<?php

declare(strict_types = 1);

namespace App\Message;

class RetryMessage
{
    private $original;
    private $type;

    public function __construct(string $original, string $type)
    {
        $this->original = $original;
        $this->type = $type;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
