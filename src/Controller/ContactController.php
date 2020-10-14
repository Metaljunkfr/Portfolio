<?php


namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(EntityManagerInterface $em, Request $request,  MailerInterface $mailer)
    {
        $contact = new Contact;

        //Création du formulaire
        $contactForm = $this->createForm(\App\Form\ContactType::class, $contact);

        //Traitement de la requête
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $contact = $contactForm->getData();

            //Création nouvel objet Email
            $message = (new TemplatedEmail())

            //Contenu du mail
            ->from('contact@guillaumegeorges.fr')
            ->to($contact->getEmail())
            ->bcc('contact@guillaumegeorges.fr')
            ->subject('Objet : À propos de votre message')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' =>$contact
                ]);
            $mailer->send($message);

            //Si les données sont validées, alors on les rentrent en base de données(persist) et on enregistre (flush)
            $contact->setIsPublished(true);
            $em->persist($contact);
            $em->flush();

            //Ajout d'un message de validation
            $this->addFlash('success', 'Votre message a bien été envoyé!');
            return $this->redirectToRoute("contact");
        }

        if ($contactForm->isSubmitted() && $contactForm->getErrors())
        {
            //Message d'erreur
            $this->addFlash('error', 'Une erreur s\'est produite!');
        }

        //Pour valider le formulaire
        return $this->render("app/contact.html.twig", [
            "contactForm" =>$contactForm->createView()
        ]);
    }
}