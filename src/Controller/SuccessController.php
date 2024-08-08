<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class SuccessController extends AbstractController
{
    #[Route('/success', name: 'app_success')]
    public function index(): Response
    {
        return $this->render('success/index.html.twig', [
            'controller_name' => 'SuccessController',
        ]);
    }

    #[Route('/sendEmail', name: 'send_email', methods: ['POST'])]
    public function sendMessage(Request $request, MailerInterface $mailer, LoggerInterface $logger): Response
    {
        $name = $request->request->get('name');
        $fromEmail = $request->request->get('email');
        $subject = $request->request->get('subject');
        $messageContent = $request->request->get('message');

        // Vérification des paramètres reçus
        $logger->info("Parameters: name={$name}, fromEmail={$fromEmail}, subject={$subject}, messageContent={$messageContent}");


        // Création de l'email
        try {
            $email = (new Email())
                ->from($fromEmail)
                ->to('kellymanambina@gmail.com')
                ->subject($subject)
                ->text('Sending emails is fun again!')
                ->html('<p>Bonjour,</p><p>Vous avez un nouveau message de ' . $name . '.</p><p>Sujet: ' . $subject . '</p><p>Message:</p><p>' . nl2br($messageContent) . '</p>');


            // Envoi de l'email
            $mailer->send($email);

            $logger->info("Email sent successfully to kellymanambina@gmail.com from {$fromEmail}");
        } catch (\Exception $e) {
            $logger->error('Failed to send email: ' . $e->getMessage());
            return new Response('Erreur lors de l\'envoi de l\'email.'.$e , 500);
        }

        return $this->redirectToRoute('app_success', [
            'controller_name' => 'SuccessController',
        ]);
    }
}
