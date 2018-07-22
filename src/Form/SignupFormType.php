<?php

declare(strict_types = 1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SignupFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Dein Vorname',
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Dein Nachname',
                ]
            )
            ->add(
                'emailAddress',
                EmailType::class,
                [
                    'required' => true,
                    'label' => 'Deine Emailadresse',
                ]
            )
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'required' => true,
                    'first_options' => [
                        'label' => 'Bitte wähle ein Passwort',
                    ],
                    'second_options' => [
                        'label' => 'Bitte wiederhole Dein Passwort',
                    ],
                ]
            )
            ->add(
                'acceptTerms',
                CheckboxType::class,
                [
                    'required' => true,
                    'mapped' => false,
                    'label' => 'Bitte bestätige unsere AGBs.',
                ]
            )
            ->add(
                'signup',
                SubmitType::class,
                [
                    'label' => 'Registrierung abschließen',
                ]
            )
        ;
    }
}
