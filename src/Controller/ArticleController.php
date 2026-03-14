<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article_index')]
public function index(EntityManagerInterface $entityManager): Response
{
    $articlesFromDb = $entityManager->getRepository(Article::class)->findAll();

    $articlesData = [];
    foreach ($articlesFromDb as $article) {
        $articlesData[] = [
            'id'     => $article->getId(),
            'title'  => $article->getTitle(),
            'author' => $article->getAuthor() ? $article->getAuthor()->getName() : 'Autore sconosciuto',
        ];
    }

    return $this->render('article/index.html.twig', [
        'articles_json' => json_encode($articlesData), 
    ]);
}
}