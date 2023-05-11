<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')]
    public function index(): Response
    {
        return $this->render('training/training.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }
}
