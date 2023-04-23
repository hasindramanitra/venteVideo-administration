<?php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCrudController extends AbstractController
{
    #[Route('/Admin/User', name:"admin.user", methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository):Response
    {
        return $this->render('Admin/User/index.html.twig', [
            'users'=>$userRepository->findAll()
        ]);
    }

    #[Route('/Admin/User/new', name:'adminUser.new', methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(EntityManagerInterface $entityManagerInterface, Request $request):Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin.user");
        }
        return $this->render('Admin/User/new.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/Admin/User/update/{id<\d+>}', name:'adminUser.update', methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function update(EntityManagerInterface $entityManagerInterface, Request $request, User $user):Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin.user');
        }
        return $this->render('Admin/User/update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/Admin/User/delete/{id<\d+>}', name:"adminUser.delete", methods:['GET', 'POST'])]
    public function delete(EntityManagerInterface $entityManagerInterface, User $user, UserRepository $userRepository):Response
    {
        $userRepository->remove($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin.user');
    }
}