<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film', methods:['GET'])]
    public function index(FilmRepository $film): Response
    {
        
        return $this->render('film/index.html.twig', [
            'films' => $film->findAll(),
        ]);
    }
}
