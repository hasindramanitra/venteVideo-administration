<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserShowType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController 
{
    #[Route('/user/{id<\d+>}', name:"userShow", methods:['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    public function index(User $choosenUser):Response
    {
        $form = $this->createForm(UserShowType::class, $choosenUser);
        return $this->render('User/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }







    #[Route('/user/update/{id<\d+>}', name:"user.update", methods:['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    public function editUser(User $choosenUser, EntityManagerInterface $entityManagerInterface,
     Request $request, UserPasswordHasherInterface $userPasswordHasherInterface):Response
    {
        $form = $this->createForm(UserType::class, $choosenUser);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($userPasswordHasherInterface->isPasswordValid($choosenUser, $form->getData()->getplainPassword())){
                $choosenUser = $form->getData();
                $entityManagerInterface->persist($choosenUser);
                $entityManagerInterface->flush();
            }

            return $this->redirectToRoute("app_film");
        }
        return $this->render('User/update.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/user/updatePassword/{id<\d+>}', name:"user.updatePassword", methods:['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    public function editPasswordUser(User $choosenUser, EntityManagerInterface $entityManagerInterface,
    Request $request, UserPasswordHasherInterface $userPasswordHasherInterface ):Response
    {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($userPasswordHasherInterface->isPasswordValid($choosenUser, $form->getData()['plainPassword'])){
                $choosenUser->setPassword($userPasswordHasherInterface->hashPassword(
                    $choosenUser,
                    $form->getData()['newPassword']
                ));

                $entityManagerInterface->persist($choosenUser);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('app_film');
            }
        }
        return $this->render('User/updatePassword.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}