<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact')]
    public function index(Request $request, MailService $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            //Envoi mail
            try {
                $mailer->sendMail
                (
                    $data['email'],
                    $data['subject'],
                    'email/_contact.html.twig',
                    [
                        'userName' => $data['fullName'],
                        "message" => $data['message'],
                    ]);
                $this->addFlash('success', 'Votre demande de contact à bien été envoyer');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', 'Erreur dans l\'envoi du mail');
            }
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
