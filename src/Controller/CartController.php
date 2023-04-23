<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Serie;
use App\Repository\FilmRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(SessionInterface $session, FilmRepository $filmRepository, SerieRepository $serieRepository): Response
    {
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        foreach ($panier as $id => $quantite) {
            # code...
            $film = $filmRepository->find($id);
            $dataPanier[] = [
                "film" => $film,
                "quantite" => $quantite
            ];
            $total += $film->getPrice()*$quantite;
        }
        
        return $this->render('cart/index.html.twig',
            compact("dataPanier", "total")
        );
    }

    #[Route('/add/{id}', name:'cart_add_film')]
    public function add(Film $film , SessionInterface $session):Response
    {
        $panier = $session->get('panier', []);
        $id = $film->getId();
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/add/serie/{id}', name:'cart_add_serie')]
    public function addSerie(Serie $serie, SessionInterface $session):Response
    {
        $panier = $session->get('panier', []);
        $id = $serie->getId();
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);
        
        return $this->redirectToRoute('app_cart');
    }
}
