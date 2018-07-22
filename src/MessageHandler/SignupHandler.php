<?php

declare(strict_types = 1);

namespace App\MessageHandler;

use App\Message\Signup;

final class SignupHandler
{
    public function __invoke(Signup $message): void
    {
        // Do something
    }
}
