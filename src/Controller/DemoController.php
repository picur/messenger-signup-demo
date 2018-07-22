<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Form\SignupFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller
{
    public function signup()
    {
        $form = $this->createForm(SignupFormType::class);

        return $this->render(
            'signup.html.twig',
            [
                'signupForm' => $form->createView(),
            ]
        );
    }
}
