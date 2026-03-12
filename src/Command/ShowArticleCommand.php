<?php

namespace App\Command;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:show-article',
    description: 'Visualizza i dettagli di un articolo e del suo autore',
)]
class ShowArticleCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED, 'L\'ID dell\'articolo');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        // 1. Cerchiamo l'articolo
        $article = $this->entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            $io->error("Articolo con ID $id non trovato!");
            return Command::FAILURE;
        }

        // 2. Otteniamo l'autore tramite la relazione
        $author = $article->getAuthor();

        // 3. Mostriamo i dati come richiesto dall'esercizio
        $io->title("Dettagli Articolo #$id");
        
        $io->section('Informazioni Articolo');
        $io->text("Titolo: " . $article->getTitle());
        $io->text("Contenuto: " . $article->getContent());
        $io->text("Data: " . $article->getPublishedAt()->format('d/m/Y H:i'));

        $io->section('Informazioni Autore');
        $io->text("Nome: " . $author->getName());
        $io->text("Email: " . $author->getEmail());

        return Command::SUCCESS;
    }
}
