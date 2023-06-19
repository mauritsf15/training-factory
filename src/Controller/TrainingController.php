<?php

namespace App\Controller;

use App\Form\EditClassType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassesRepository;
use App\Entity\Classes;
use App\Entity\User;
use App\Entity\Enrollments;
use App\Repository\EnrollmentsRepository;
use App\Form\AddClassType;
use Symfony\Component\HttpFoundation\Request;

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
    public function addtraining(ClassesRepository $classesRepository, Request $request): Response
    {
        $classes = $classesRepository->findAll();
        
        $class = new Classes();

        $form = $this->createForm(AddClassType::class, $class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $class = $form->getData();
            $classesRepository->save($class);
            $this->addFlash('succes', 'Nieuwe training is aangemaakt!');
            return $this->redirectToRoute('app_training');
        } else {
            return $this->renderForm('training/addtraining.html.twig', [
                'page' => 'addtraining',
                'classes' => $classes,
                'form' => $form,
            ]);
        }
    }

    #[Route('/class/{id}', name: 'app_class')]
    public function class(ClassesRepository $classesRepository, EnrollmentsRepository $enrollmentsRepository, UserRepository $userRepository, $id): Response
    {
        $class = $classesRepository->findOneBy(['id' => $id]);
        $classEnrollments = $enrollmentsRepository->findBy(['Class' => $class]);

        $usersEnrolled = array_map(function ($enrollment) {
            return $enrollment->getUser();
        }, $classEnrollments);

        $user = $userRepository->findOneBy(['id' => $this->getUser()->getId()]);
        $checkIfEnrolled = $enrollmentsRepository->findBy(['User' => $this->getUser()->getId(), 'Class' => $class]);
        $enrolled = false;

        if(count($checkIfEnrolled) != 0) {
            $enrolled = true;
        }



        return $this->render('training/class.html.twig', [
            'page' => 'class',
            'class' => $class,
            'enrollments' => $usersEnrolled,
            'enrolled' => $enrolled,
            'user' => $user,
        ]);
    }

    #[Route('/class/edit/{id}', name: 'app_edit_class')]
    public function editclass(ClassesRepository $classesRepository, Request $request, $id): Response
    {
        $class = $classesRepository->find($id);
        $form = $this->createForm(EditClassType::class, $class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $class = $form->getData();
            $classesRepository->save($class);
            $this->addFlash('succes', 'Class is bewerkt!');
            return $this->redirectToRoute('app_training');
        } else {
            return $this->renderForm('training/editclass.html.twig', [
                'page' => 'editclass',
                'class' => $class,
                'form' => $form,
            ]);
        }
    }

    #[Route('/class/enroll/{id}/{userid}', name: 'app_enroll')]
    public function enroll(ClassesRepository $classesRepository, UserRepository $userRepository, EnrollmentsRepository $enrollmentsRepository,$id, $userid): Response
    {
        $user = $userRepository->findOneBy(['id' => $userid]);
        $class = $classesRepository->findOneBy((['id' => $id]));

        $checkIfEnrolled = $enrollmentsRepository->findBy(['User' => $user, 'Class' => $class]);

        if (count($checkIfEnrolled) == 0) {

            $enrollment = new Enrollments();
            $enrollment->setClass($class);
            $enrollment->setUser($user);

            $enrollmentsRepository->save($enrollment);

            $this->addFlash('succes', 'Je staat nu ingeschreven voor deze training!');

            return $this->redirectToRoute('app_index');

        } else {
            $this->addFlash('succes', 'Je bent nu uitgeschreven voor deze training!');

            $enrollmentsRepository->remove($checkIfEnrolled[0]);

            return $this->redirectToRoute('app_training');
        }
    }



}
