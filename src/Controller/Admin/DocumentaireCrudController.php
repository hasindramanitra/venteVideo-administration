<?php
namespace App\Controller\Admin;

use App\Entity\Documentaire;
use App\Form\DocumentaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DocumentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DocumentaireCrudController extends AbstractController
{
    #[Route('/Admin/Documentaire', name:"admin.documentaire", methods:['GET'])]
    #[IsGranted('ADMIN')]
    public function index(DocumentaireRepository $documentaireRepository):Response
    {
        return $this->render('Admin/Documentaire/index.html.twig', [
            'doc'=>$documentaireRepository->findAll()
        ]);
    }

    #[Route('/Admin/Documentaire/new', name:"adminDoc.new", methods:['GET', 'POST'])]
    #[IsGranted('ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {

        $documentaire = new Documentaire();
        $form = $this->createForm(DocumentaireType::class, $documentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $documentaire = $form->getData();
            $entityManagerInterface->persist($documentaire);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.documentaire');
        }
        return $this->render('Admin/Documentaire/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Documentaire/update/{id<\d+>}', name:"adminDoc.update", methods:['GET', 'POST'])]
    #[IsGranted('ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface, Request $request, Documentaire 
    $documentaire):Response
    {

        $form = $this->createForm(DocumentaireType::class, $documentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $documentaire = $form->getData();
            $entityManagerInterface->persist($documentaire);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.documentaire');
        }
        return $this->render('Admin/Documentaire/update.html.twig', [
            'form'=>$form-> createView()
        ]);
    }

    #[Route('/Admin/Documentaire/delete/{id<\d+>}', name:"adminDoc.delete", methods:['GET', 'POST'])]
    public function delete(DocumentaireRepository $documentaireRepository, 
    EntityManagerInterface $entityManagerInterface, Documentaire $documentaire):Response
    {
        $documentaireRepository->remove($documentaire);
        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin.documentaire");
    }
}