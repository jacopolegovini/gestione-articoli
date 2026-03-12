<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProvaController extends AbstractController
{
    #[Route('/', name: 'app_prova')] // Abbiamo messo / per la home
    public function index(): Response
    {
        // Questo cerca il file in templates/prova/index.html.twig
        return $this->render('prova/index.html.twig', [
            'controller_name' => 'ProvaController',
        ]);
    }
}
