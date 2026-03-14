<?php

namespace App\Controller;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/authors', name: 'app_authors_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $authors = $entityManager->getRepository(Author::class)->findAll();

        $authorsData = [];
        foreach ($authors as $author) {
            $authorsData[] = [
                'id' => $author->getId(),
                'name' => $author->getName(),
                'email' => $author->getEmail(),
                'articlesCount' => count($author->getArticles()),
            ];
        }

        // 3. Spedisce tutto al template Twig
        return $this->render('author/index.html.twig', [
            'authors_json' => json_encode($authorsData),
        ]);
    }
}
