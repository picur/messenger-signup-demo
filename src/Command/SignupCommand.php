<?php

declare(strict_types = 1);

namespace App\Command;

use App\Message\Signup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerConfiguration;

class SignupCommand extends Command
{
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:signup')
            ->setDescription('Perform user signup via command line.')
            ->addArgument('firstName', InputArgument::REQUIRED, 'Dein Vorname')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Dein Nachname')
            ->addArgument('email', InputArgument::REQUIRED, 'Deine Emailadresse')
            ->addArgument('password', InputArgument::REQUIRED, 'Bitte wähle ein Passwort')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Demo-Registrierung');
        $io->text('Benutzeraccount anlegen');

        $command = new Signup(
            $input->getArgument('firstName'),
            $input->getArgument('lastName'),
            $input->getArgument('email'),
            $input->getArgument('password')
        );

        $envelope = new Envelope($command);
        $envelope->with(new SerializerConfiguration(['groups' => ['signup']]));

        $this->commandBus->dispatch($envelope);

        return 0;
    }
}
