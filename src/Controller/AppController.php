<?php

namespace App\Controller;

use App\Entity\Realisation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

//Contrôleur principal avec les différentes routes
class AppController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        //Récupération données en base pour afficher dernières réalisations sur page d'accueil
        $realisationRepo = $this->getDoctrine()->getRepository(Realisation::class);
        $realisations = $realisationRepo->trouvederniererealisationpardatecreadesc();
        return $this->render("app/accueil.html.twig", [
            "realisations" => $realisations
        ]);
    }

    /**
     * @Route("/curriculumvitae/", name="curriculumvitae")
     */
    public function curriculumvitae()
    {
        return $this->render("app/curriculumvitae.html.twig");
    }

    /**
     * @Route("/mentionslegales/", name="mentionslegales")
     */
    public function mentionslegales()
    {
        return $this->render("app/mentionslegales.html.twig");
    }


}