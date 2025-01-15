<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route('/contact/submit', name: 'contact_submit', methods: ['POST'])]
    public function submit(Request $request): Response
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $message = $request->request->get('message');

        if (empty($name) || empty($email) || empty($message)) {
            $this->addFlash('error', 'Tous les champs doivent être remplis.');
            return $this->redirectToRoute('app_contact');
        }

        $this->addFlash('success', 'Votre message a bien été envoyé !');
        return $this->redirectToRoute('app_contact');
    }
}