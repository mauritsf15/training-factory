<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// import users repository
use App\Repository\UserRepository;
use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;

// import user form

use App\Form\UserType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(UserRepository $userRepository): Response
    {
        // get all users
        $users = $userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'page' => 'admin',
            'users' => $users
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

        return $this->renderForm('admin/edit.html.twig', [
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

        return $this->render('admin/new.html.twig', [
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
}
