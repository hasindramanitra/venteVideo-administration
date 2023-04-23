<?php
namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreCrudController extends AbstractController
{
    #[Route('/Admin/Genre', name:"admin.genre", methods:['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(GenreRepository $genreRepository):Response
    {
        return $this->render('Admin/Genre/index.html.twig', [
            'genres'=>$genreRepository->findAll()
        ]);
    }

    #[Route('/Admin/Genre/new', name:"adminGenre.new", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {

        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $genre = $form->getData();
            $entityManagerInterface->persist($genre);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin.genre");
        }
        return $this->render('Admin/Genre/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Genre/update/{id<\d+>}', name:"adminGenre.update", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface, Request $request,
    Genre $genre):Response
    {
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $genre = $form->getData();
            $entityManagerInterface->persist($genre);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.genre');
        }
        return $this->render('Admin/Genre/update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Genre/delete/{id<\d+>}', name:"adminGenre.delete", methods:['GET', 'POST'])]
    public function delete(EntityManagerInterface $entityManagerInterface, GenreRepository $genreRepository,
    Genre $genre):Response
    {
        $genreRepository->remove($genre);
        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin.genre");
    }
}