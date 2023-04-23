<?php
namespace App\Controller\Admin;

use App\Entity\Saison;
use App\Form\SaisonType;
use App\Repository\SaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaisonCrudController extends AbstractController
{
    #[Route('/Admin/Saison', name:"admin.saison", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(SaisonRepository $saisonRepository):Response
    {
        return $this->render('Admin/Saison/index.html.twig', [
            'saisons'=>$saisonRepository->findAll()
        ]);
    }

    #[Route('/Admin/Saison/new', name:"adminSaison.new", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {
        $saison = new Saison();
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $saison = $form->getData();
            $entityManagerInterface->persist($saison);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.saison');
        }
        return $this->render('Admin/Saison/new.html.twig', [
             'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/Saison/update/{id<\d+>}', name:"adminSaison.update", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface,
    Request $request, Saison $saison):Response
    {
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $saison = $form->getData();
            $entityManagerInterface->persist($saison);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin.saison");
        }
        return $this->render('Admin/Saison/update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('Admin/Saison/delete/{id<\d+>}', name:"adminSaison.delete", methods:['GET', 'POST'])]
    public function delete(SaisonRepository $saisonRepository , Saison $saison, EntityManagerInterface
    $entityManagerInterface):Response
    {
        $saisonRepository->remove($saison);
        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin.saison");

    }
}