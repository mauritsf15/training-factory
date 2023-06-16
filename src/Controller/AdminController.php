<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// import users repository
use App\Repository\UserRepository;
use App\Entity\User;

use App\Repository\TrainingsRepository;
use App\Entity\Trainings;

use Symfony\Component\HttpFoundation\Request;

// import user form

use App\Form\UserType;
use App\Form\TrainingType;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(UserRepository $userRepository, TrainingsRepository $trainingsRepository): Response
    {
        // get all users
        $users = $userRepository->findAll();

        $trainings = $trainingsRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'page' => 'admin',
            'users' => $users,
            'trainings' => $trainings,
        ]);
    }

    /**
     * @Route("/admin/user/{id}/edit", name="app_admin_user_edit")
     */
    public function edit(User $user, Request $request, UserRepository $userRepository): Response
    {
        // Handle edit form submission
        // ...

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$user` variable has also been updated
            $user = $form->getData();

            // save user
            $userRepository->save($user);

            // redirect to admin page
            return $this->redirectToRoute('app_admin');
        }

        return $this->renderForm('admin/user/edit.html.twig', [
            'page' => 'admin',
            'form' => $form,
            'user' => $user,
        ]);
    }

   /**
     * @Route("/admin/user/new", name="app_admin_user_new")
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // save the new user to the database
            $userRepository->save($user);

            // redirect to the admin index page
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/user/new.html.twig', [
            'page' => 'admin',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/{id}/delete", name="app_admin_user_delete")
     */
    public function delete(User $user, Request $request, UserRepository $userRepository): Response
    {
        
        // delete user

        $userRepository->remove($user);

        return $this->redirectToRoute('app_admin');
    }


        /**
     * @Route("/admin/trainings/new", name="app_admin_trainings_new")
     */
    public function trainingsNew(Request $request, TrainingsRepository $trainingsRepository): Response
    {
        $training = new Trainings();
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();

            $trainingsRepository->save($training);

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/trainings/new.html.twig', [
            'page' => 'admin',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/trainings/{id}/edit", name="app_admin_trainings_edit")
     */
    public function trainingsEdit(Trainings $training, Request $request, TrainingsRepository $trainingsRepository): Response
    {
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();

            $trainingsRepository->save($training);

            return $this->redirectToRoute('app_admin');
        }

        return $this->renderForm('admin/trainings/edit.html.twig', [
            'page' => 'admin',
            'form' => $form,
            'training' => $training,
        ]);
    }

    /**
     * @Route("/admin/trainings/{id}/delete", name="app_admin_trainings_delete")
     */
    public function trainingsDelete(Trainings $training, Request $request, TrainingsRepository $trainingsRepository): Response
    {
        $trainingsRepository->remove($training);

        return $this->redirectToRoute('app_admin');
    }
    
}
