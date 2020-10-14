<?php


namespace App\Controller;

use App\Entity\Recommandation;
use App\Form\RecommandationType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class RecommandationController extends AbstractController
{
    /**
     * @Route ("/recommandation/", name="recommandation_liste_date_recent")
     */
    public function liste_date_recent ()
    {
        //Allez chercher les données en bdd
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);

        //Avec la fonction on tri d'une certaine façon
        $recommandations = $recommandationRepo->trouvederniererecommandationpardatedesc();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }

    /**
     * @Route ("/recommandation/datev", name="recommandation_liste_date_vieux")
     */
    public function liste_date_vieux ()
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandations = $recommandationRepo->trouvederniererecommandationpardateasc();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }


    /**
     * @Route ("/recommandation/noma", name="recommandation_liste_nomasc")
     */
    public function liste_nomasc ()
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandations = $recommandationRepo->trouvederniererecommandationparordrealpha();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }

    /**
     * @Route ("/recommandation/nomz", name="recommandation_liste_nomdesc")
     */
    public function liste_nomdesc ()
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandations = $recommandationRepo->trouvederniererecommandationparordrealphainvers();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }


    /**
     * @Route ("/recommandation/notep", name="recommandation_liste_note_meilleure")
     */
    public function liste_note_meilleure ()
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandations = $recommandationRepo->trouvederniererecommandationparnotemeilleure();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }

    /**
     * @Route ("/recommandation/notem", name="recommandation_liste_note_moinsbonne")
     */
    public function liste_note_moinsbonne ()
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandations = $recommandationRepo->trouvederniererecommandationparnotemoinsbonne();
        return $this->render('recommandation/liste.html.twig', [
            "recommandations" => $recommandations
        ]);
    }

    //Affichage des détails pour une recommandation spécifique (par id)
    /**
     * @Route ("/recommandation/{id}", name="recommandation_detail",
     *     requirements={"id": "\d+"},
     *     methods={"GET"})
     */
    public function detail($id, Request $request)
    {
        $recommandationRepo = $this->getDoctrine()->getRepository(Recommandation::class);
        $recommandation = $recommandationRepo->find($id);

        if (empty($recommandation)){
            throw $this->createNotFoundException("Cette recommandation n'existe pas!");
        }

        return $this->render('recommandation/detail.html.twig', [
            "recommandation" => $recommandation
        ]);

    }

    //Ajout d'une recommandation
    /**
     * @Route("/recommandation/ajouter/", name="recommandation_ajouter")
     */
    public function add(EntityManagerInterface $em, Request $request, MailerInterface $mailer)
    {
        //Si l'utilisateur n'est pas connecté alors il est redirigé vers une page de connexion
        $this->denyAccessUnlessGranted('ROLE_USER');

        //Ajout d'une recommandation avec la date qui s'inscrit puis récupération email de l'utilisateur
        $recommandation = new Recommandation();
        $recommandation->setDateCreation(new \DateTime());
        $recommandation->setUtilisateur($this->getUser());
		$email= $this->getUser()->getEmail();
        $recommandationForm = $this->createForm(RecommandationType::class, $recommandation);
        $recommandationForm->handleRequest($request);
        if ($recommandationForm->isSubmitted() && $recommandationForm->isValid()){
            $recommandation->setIsPublished(true);
            $recommandation = $recommandationForm->getData();

            //Enregistrement en bdd des informations rentrées du formulaire d'ajout de recommandation
            $em->persist($recommandation);
            $em->flush();

			//Création nouvel objet Email
            $message = (new TemplatedEmail())

                //Contenu du mail
                ->from('contact@guillaumegeorges.fr')
				->to($email)
            	->bcc('contact@guillaumegeorges.fr')
                ->subject('Objet : votre recommandation a bien été postée!!')
                ->htmlTemplate('emails/recommandation.html.twig')
                ->context([
                    'recommandation' =>$recommandation
                ]);

            $mailer->send($message);

            //Message d'info après validation
            $this->addFlash('success', 'La recommandation a bien été ajoutée!');
            return $this->redirectToRoute('recommandation_detail', [
                'id' => $recommandation->getId()
            ]);
        }

        if ($recommandationForm->isSubmitted() && $recommandationForm->getErrors())
        {
            //Message d'erreur
            $this->addFlash('error', 'Une erreur s\'est produite!');
        }

        return $this->render('recommandation/ajouter.html.twig', [
            "recommandationForm" => $recommandationForm->createView()
        ]);
    }
}