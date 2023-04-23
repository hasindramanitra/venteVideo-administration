<?php 
namespace App\Services;

use App\Entity\Film;
use App\Entity\Serie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService 
{
    private RequestStack $requestStack;
    private EntityManagerInterface $manager;
    public function __construct(RequestStack $requestStack, EntityManagerInterface $manager)
    {
        $this->requestStack = $requestStack;
        $this->manager = $manager;
    }

    public function addToCart(int $id):void
    {
        $cart = $this->requestStack->getSession()->get('cart',[]);
        if(!empty($cart[$id]))
        {
            $cart[$id]++;
        }else
        {
            $cart[$id] = 1;
        }
        $this->getSession()->set('cart', $cart);
    }

    public function getTotalFilm():array
    {
        $cartsFilms = $this->getSession()->get('cart');
        $cartFilmData = [];
        if($cartsFilms)
        {
            foreach($cartsFilms as $id=>$quantity)
            {
                $film = $this->manager->getRepository(Film::class)->findOneBy(['id' => $id]);
                if(!$film)
                {

                }
                $cartFilmData[] = [
                    'film'=>$film,
                    'quantity'=>$quantity
                ];
            
            }
            
        }
        return $cartFilmData;
        
    }

    public function getTotalSerie():array
    {
        $cartsSeries = $this->getSession()->get('cart');
        $cartSerieData = [];
        if($cartsSeries)
        {
            foreach($cartsSeries as $id=>$quantity)
            {
                $serie = $this->manager->getRepository(Serie::class)->findOneBy(['id' => $id]);
                if(!$serie)
                {

                }
                $cartSerieData[] = [
                    'serie'=>$serie,
                    'quantity'=>$quantity
                ];
            
            }
            
        }
        return $cartSerieData;
        
    }
    
    

    public function removeAll()
    {
        return $this->getSession()->remove('cart');
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}