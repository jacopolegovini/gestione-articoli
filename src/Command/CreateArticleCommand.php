<?php

namespace App\Command;

use App\Entity\Article;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-article',
    description: 'Crea un nuovo articolo collegandolo a un autore esistente',
)]
class CreateArticleCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Creazione di un nuovo Articolo');

        $title = $io->ask('Titolo dell\'articolo');
        $content = $io->ask('Contenuto dell\'articolo');
        $authorEmail = $io->ask('Inserisci l\'email dell\'autore che ha scritto questo articolo');

        $author = $this->entityManager->getRepository(Author::class)->findOneBy(['email' => $authorEmail]);

        if (!$author) {
            $io->error(sprintf('Autore con email "%s" non trovato! Devi prima crearlo con app:create-author', $authorEmail));
            return Command::FAILURE;
        }

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setPublishedAt(new \DateTimeImmutable());
        
        $article->setAuthor($author);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $io->success(sprintf('Articolo "%s" creato e collegato all\'autore %s!', $title, $author->getName()));

        return Command::SUCCESS;
    }
}
