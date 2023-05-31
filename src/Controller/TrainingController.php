<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassesRepository;

class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')]
    public function index(ClassesRepository $classesRepository): Response
    {
        $classes = $classesRepository->findAll();

        return $this->render('training/training.html.twig', [
            'page' => 'training',
            'classes' => $classes,
        ]);
    }

    #[Route('/addtraining', name: 'app_addtraining')]
    public function addtraining(ClassesRepository $classesRepository): Response
    {
        $classes = $classesRepository->findAll();

        return $this->render('training/addtraining.html.twig', [
            'page' => 'addtraining',
            'classes' => $classes,
        ]);
    }
}
