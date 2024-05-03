<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
              $email = (new Email())
                ->from($contactData['mail'])
                ->to('zizigo45@gmail.com') 
                ->subject($contactData['subject'])
                ->html($this->renderView(
                    'emails/contact.html.twig', 
                    ['name' => $contactData['name'], 'message' => $contactData['message']]
                ));
    
            $mailer->send($email);
    
            return $this->render('emails/success.html.twig', [
                'message' => 'Votre email a bien été envoyé.'
            ]);
        }
    
        return $this->render('Public/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}

