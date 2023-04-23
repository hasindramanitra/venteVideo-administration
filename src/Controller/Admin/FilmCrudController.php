<?php
namespace App\Controller\Admin;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmCrudController extends AbstractController
{
    #[Route('/Admin/Film', name:"admin.film", methods:['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(FilmRepository $filmRepository):Response
    {
        return $this->render('Admin/Film/index.html.twig', [
            'films' => $filmRepository->findAll()
        ]);
    }

    #[Route('/Admin/Film/new', name:"adminFilm.new", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {

        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $film = $form->getData();
            $entityManagerInterface->persist($film);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin.film");
        }
        return $this->render('Admin/Film/new.html.twig', [
            "form"=>$form->createView()
        ]);
    }

    #[Route('/Admin/Film/update/{id<\d+>}', name:"adminFilm.update", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface, Request $request, Film $film):Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $film = $form->getData();
            $entityManagerInterface->persist($film);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin.film");
        }
        return $this->render('Admin/Film/update.html.twig', [
            "form" =>$form->createView()
        ]);
    }

    #[Route('/Admin/Film/delete/{id}', name:"adminFilm.delete", methods:['GET', 'POST'])]
    public function delete(FilmRepository $filmRepository, Film $film, EntityManagerInterface $entityManagerInterface):Response
    {
        $filmRepository->remove($film);
        $entityManagerInterface->flush();
        return $this->redirectToRoute("admin.film");

    }
}