<?php

namespace App\Command;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-author',
    description: 'Crea un nuovo autore nel database',
)]
class CreateAuthorCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Creazione di un nuovo Autore');

        $name = $io->ask('Nome dell\'autore');
        $email = $io->ask('Email dell\'autore');

        if (!$name || !$email) {
            $io->error('Nome ed Email sono obbligatori!');
            return Command::FAILURE;
        }

        $author = new Author();
        $author->setName($name);
        $author->setEmail($email);

        $this->entityManager->persist($author);
        $this->entityManager->flush();

        $io->success(sprintf('Autore "%s" creato con successo!', $name));

        return Command::SUCCESS;
    }
}
