<?php
namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminHomeController extends AbstractController
{
    #[Route('/administration', name:"admin", methods:['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index():Response
    {
        return $this->render('Admin/index.html.twig');
    }
}