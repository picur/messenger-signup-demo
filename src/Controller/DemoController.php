<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Form\SignupFormType;
use App\Message\Signup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class DemoController extends Controller
{
    public function signup(Request $request, MessageBusInterface $commandBus)
    {
        $form = $this->createForm(SignupFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = new Signup(
                $form->get('firstName')->getData(),
                $form->get('lastName')->getData(),
                $form->get('emailAddress')->getData(),
                $form->get('password')->getData()
            );

            $commandBus->dispatch($message);
        }

        return $this->render(
            'signup.html.twig',
            [
                'signupForm' => $form->createView(),
            ]
        );
    }
}
