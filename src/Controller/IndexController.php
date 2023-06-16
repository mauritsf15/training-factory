<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassesRepository;
use App\Form\UserType;

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

    #[Route('/rules', name: 'app_rules')]
    public function rules(): Response
    {
        return $this->render('index/rules.html.twig', [
            'page' => 'rules',
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
    public function editprofile(UserRepository $userRepository, Request $request): Response
    {
        $userid = $this->getUser()->getId();

        $user = $userRepository->findOneBy(['id' => $userid]);

        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepository->save($user);
            $this->addFlash('success', 'Gegevens opgeslagen');
            return $this->redirectToRoute('app_profile');
        } else {
            return $this->renderForm('index/editprofile.html.twig', [
                'page' => 'editprofile',
                'user' => $user,
                'form' => $form,
            ]);
        }
    }
}
