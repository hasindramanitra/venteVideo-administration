<?php
namespace App\Controller\Admin;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SerieCrudController extends AbstractController
{

    #[Route('/Admin/Serie', name:"admin.serie", methods:['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(SerieRepository $serieRepository):Response
    {

        return $this->render('Admin/Serie/index.html.twig', [
            'series' =>$serieRepository->findAll()
        ]);
    }

    #[Route('/Admin/Serie/new', name:"adminSerie.new", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $serie = $form->getData();
            $entityManagerInterface->persist($serie);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.serie');
        }

        return $this->render('Admin/Serie/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Serie/update/{id<\d+>}', name:"adminSerie.update", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface
    , Request $request, 
    Serie $serie):Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $serie = $form->getData();
            $entityManagerInterface->persist($serie);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.serie');
        }
        return $this->render('Admin/Serie/update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Serie/delete/{id<\d+>}', name:"adminSerie.delete", methods:['GET', 'POST'])]
    public function delete(SerieRepository $serieRepository , Serie $serie , EntityManagerInterface $entityManagerInterface):Response
    {
        $serieRepository->remove($serie);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('admin.serie');
    }
}