<?php

namespace App\Controller;

use App\Repository\UserRepository;
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
    public function profile(UserRepository $userRepository): Response
    {

        $userid = $this->getUser()->getId();

        $user = $userRepository->findOneBy(['id' => $userid]);

        return $this->render('index/profile.html.twig', [
            'page' => 'profile',
            'user' => $user,
        ]);
    }

    #[Route('/editprofile', name: 'app_editprofile')]
    public function editprofile(UserRepository $userRepository): Response
    {
    }
}
