<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassesRepository;
use App\Entity\Classes;
use App\Entity\User;

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

    #[Route('/class/{id}', name: 'app_class')]
    public function class(ClassesRepository $classesRepository, $id): Response
    {
        $class = $classesRepository->findOneBy(['id' => $id]);

        return $this->render('training/class.html.twig', [
            'page' => 'class',
            'class' => $class,
        ]);
    }

    #[Route('/enroll/{id}/{userid}', name: 'app_enroll')]
    public function enroll(ClassesRepository $classesRepository, Classes $classes, UserRepository $userRepository, $id, $userid): Response
    {
        $user = $userRepository->findOneBy(['id' => $userid]);
        $class = $classesRepository->findOneBy((['id' => $id]));
        $class->addEnrollment($user);

        $classesRepository->save($class);

        return $this->redirectToRoute('app_index');
    }
}
