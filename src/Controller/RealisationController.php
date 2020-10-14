<?php


namespace App\Controller;

use App\Entity\Realisation;
use App\Entity\Utilisateur;
use App\Form\RealisationType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class RealisationController extends AbstractController
{
    //Récupération en base des données et affichage après tri effectué dans le repository
    //Affichage par date de création ou d'upload, par nom
    /**
     * @Route ("/realisation/dater", name="realisation_liste_date_recent")
     */
    public function liste_date_recent ()
    {
        //Allez chercher les données en bdd
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);

        //Avec la fonction on tri d'une certaine façon
        $realisations = $realisationRepo->trouvederniererealisationpardatedesc();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route ("/realisation/datev", name="realisation_liste_date_vieux")
     */
    public function liste_date_vieux ()
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationpardateasc();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route ("/realisation/", name="realisation_liste_date_creadesc")
     */
    public function liste_date_creadesc ()
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationpardatecreadesc();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route ("/realisation/datec", name="realisation_liste_date_creaasc")
     */
    public function liste_date_creaasc ()
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationpardatecreaasc();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route ("/realisation/noma", name="realisation_liste_nomasc")
     */
    public function liste_nomasc ()
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationparordrealpha();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route ("/realisation/nomz", name="realisation_liste_nomdesc")
     */
    public function liste_nomdesc ()
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationparordrealphainvers();
        return $this->render('realisation/liste.html.twig', [
            "realisations" => $realisations
        ]);
    }


    //Affichage des détails pour une réalisation spécifique (par id)
    /**
     * @Route ("/realisation/{id}", name="realisation_detail",
     *     requirements={"id": "\d+"},
     *     methods={"GET"})
     */
    public function detail($id, Request $request)
    {
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisation = $realisationRepo->find($id);
        if (empty($realisation)){
            throw $this->createNotFoundException("Cette réalisation n'existe pas!");
        }

        return $this->render('realisation/detail.html.twig', [
            "realisation" => $realisation
        ]);
    }

    //Ajout d'une réalisation
    /**
     * @Route("/realisation/ajouter/", name="realisation_ajouter")
     */
    public function add(EntityManagerInterface $em, Request $request, MailerInterface $mailer)
    {
        //Si l'utilisateur n'est pas admin alors il est redirigé vers une page de connexion
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        //Ajout d'une réalisation avec la date qui s'inscrit
        $realisation = new Realisation();
        $realisation->setDateCreation(new \DateTime());
        $email= $this->getUser()->getEmail();
        $realisationForm = $this->createForm(RealisationType::class, $realisation);
        $realisationForm->handleRequest($request);

        if ($realisationForm->isSubmitted() && $realisationForm->isValid()) {
            $realisation->setIsPublished(true);

            //Enregistrement en bdd des informations rentrées du formulaire d'ajout de réalisation
            $em->persist($realisation);
            $em->flush();

            //Création nouvel objet Email
                $message = (new TemplatedEmail())

                    //Contenu du mail
                    ->from('contact@guillaumegeorges.fr')
                    ->to($email)
                    ->bcc('contact@guillaumegeorges.fr')
                    ->subject('Objet : votre réalisation a bien été postée!!')
                    ->htmlTemplate('emails/realisation.html.twig')
                    ->context([
                        'realisation' =>$realisation
                    ]);
                $mailer->send($message);

            //Message d'info après validation
            $this->addFlash('success', 'La réalisation a bien été ajoutée!');
            return $this->redirectToRoute('realisation_detail', [
                'id' => $realisation->getId()
            ]);
        }

        if ($realisationForm->isSubmitted() && $realisationForm->getErrors())
        {
            //Message d'erreur
            $this->addFlash('error', 'Une erreur s\'est produite!');
        }

        return $this->render('realisation/ajouter.html.twig', [
            "realisationForm" => $realisationForm->createView()
        ]);
    }
}