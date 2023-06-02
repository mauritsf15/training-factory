<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassesRepository;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'page' => 'home',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('index/contact.html.twig', [
            'page' => 'contact',
        ]);
    }

    #[Route('/404', name: 'app_denied')]
    public function denied(): Response
    {
        return $this->render('index/404.html.twig', [
            'page' => '404',
        ]);
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('index/profile.html.twig', [
            'page' => 'profile',
        ]);
    }
}
