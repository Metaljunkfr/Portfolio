<?php


namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Form\ModificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UtilisateurController extends AbstractController
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request,
                             EntityManagerInterface $em,
                             UserPasswordEncoderInterface $encoder,
							   MailerInterface $mailer)
    {
        //Création nouvelle instance utilisateur
        $utilisateur = new Utilisateur();

        //Ajout d'une date de création et d'un rôle à l'inscription
        $utilisateur -> setDateCreation(new \DateTime());
        $utilisateur -> setRoles("ROLE_USER");

        //Création de l'instance de la classe formulaire d'inscription
        $inscriptionForm = $this->createForm(InscriptionType::class, $utilisateur);

        //Récupération des données rentrées dans le formulaire
        $inscriptionForm->handleRequest($request);

        //Si inscription ne retourne pas d'erreur
        if ($inscriptionForm->isSubmitted() && $inscriptionForm->isValid())
        {
            //hasher le mot de passe
            $hasher = $encoder->encodePassword($utilisateur, $utilisateur->getMotdepasse());
            $utilisateur->setMotdepasse($hasher);

            //Valider et rentrer les données en base
            $em->persist($utilisateur);
            $em->flush();
			$email= $utilisateur->getEmail();
			
			//Création nouvel objet Email
            $message = (new TemplatedEmail())

                //Contenu du mail
                ->from('contact@guillaumegeorges.fr')
				->to($email)
            	->bcc('contact@guillaumegeorges.fr')
                ->subject('Objet : votre inscription a bien été prise en compte!!')
                ->htmlTemplate('emails/inscription.html.twig')
                ->context([
                    'utilisateur' =>$utilisateur
                ]);
            $mailer->send($message);

            //Message de confirmation d'inscription puis redirection automatique vers la page d'authentification
            $this->addFlash('success', 'L\'inscription a bien été effectuée!');
            return $this->redirectToRoute("connexion");
        }

        if ($inscriptionForm->isSubmitted() && $inscriptionForm->getErrors())
        {
            //Message d'erreur
            $this->addFlash('error', 'Une erreur s\'est produite!');
        }

        //Passer le formulaire à Twig
        return $this->render('utilisateur/inscription.html.twig', [
            'controller_name' => 'UtilisateurController', "inscriptionForm" =>$inscriptionForm->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(AuthenticationUtils $authUtils)
    {
        $erreur = $authUtils->getLastAuthenticationError();
        $dernierPseudo = $authUtils->getLastUsername();
        return $this->render('utilisateur/connexion.html.twig', [
            'dernierPseudo' => $dernierPseudo,
            'erreur'         => $erreur,
        ]);
    }

    //Symfony gère entièrement cette route!!!
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

	/**
     * @Route("/votreprofil", name="votreprofil")
     */
    public function votreprofil(Request $request,
                              EntityManagerInterface $em,
                              UserPasswordEncoderInterface $encoder, MailerInterface $mailer)
    {
        //Création nouvelle instance utilisateur
        $utilisateur = new Utilisateur();
        $utilisateur = $this->getUser();

        //Création de l'instance de la classe formulaire de modification
        $modificationForm = $this->createForm(ModificationType::class, $utilisateur);

        //Récupération des données rentrées dans le formulaire
        $modificationForm->handleRequest($request);

        //Si modification ne retourne pas d'erreur
        if ($modificationForm->isSubmitted() && $modificationForm->isValid())
        {
            //hasher le mot de passe
            $hasher = $encoder->encodePassword($utilisateur, $utilisateur->getMotdepasse());
            $utilisateur->setMotdepasse($hasher);

            //Valider et rentrer les données en base
            $em->persist($utilisateur);
            $em->flush();

            $email= $utilisateur->getEmail();

            //Création nouvel objet Email
            $message = (new TemplatedEmail())

                //Contenu du mail
                ->from('contact@guillaumegeorges.fr')
                ->to($email)
                ->bcc('contact@guillaumegeorges.fr')
                ->subject('Objet : votre profil a bien été modifié!!')
                ->htmlTemplate('emails/modification.html.twig')
                ->context([
                    'utilisateur' =>$utilisateur
                ]);
            $mailer->send($message);

            //Message de confirmation de modification puis redirection automatique vers la page d'authentification
            $this->addFlash('success', 'La modification a bien été effectuée!');
            return $this->redirectToRoute("accueil");
        }

        if ($modificationForm->isSubmitted() && $modificationForm->getErrors())
        {
            //Message d'erreur
            $this->addFlash('error', 'Une erreur s\'est produite!');
        }

        //Passer le formulaire à Twig
        return $this->render('utilisateur/modification.html.twig', [
            "modificationForm" =>$modificationForm->createView()
        ]);
    }
}