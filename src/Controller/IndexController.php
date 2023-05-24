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

    #[Route('/trainings', name: 'app_trainings')]
    public function trainings(ClassesRepository $classesRepository): Response
    {
        $classes = $classesRepository->findAll();
        
        return $this->render('index/trainings.html.twig', [
            'page' => 'training',
            'classes' => $classes,
        ]);
    }
}
