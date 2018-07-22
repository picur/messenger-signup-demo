<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Message\Signup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiDemoController extends Controller
{
    public function signup(Request $request, SerializerInterface $serializer, MessageBusInterface $commandBus)
    {
        $data = json_decode($request->getContent(), true);
        $message = new Signup($data['firstName'], $data['lastName'], $data['email'], $data['password']);

        try {
            $commandBus->dispatch($message);
        } catch (ValidationFailedException $validationFailedException) {
            $errors = $serializer->serialize($validationFailedException->getViolations(), 'json');

            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
