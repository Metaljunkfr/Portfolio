<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRecommandationRepository")
 */
class CategorieRecommandation
{
    //Définition des différents champs de la base de données avec caractéristiques
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nom;

    //Relation onetomany avec entité Recommandation
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recommandation", mappedBy="categorieRecommandation", cascade={"remove"})
     */
    private $recommandations;

    public function __construct()
    {
        $this->recommandations = new ArrayCollection();
    }

    //Getters et setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getRecommandations()
    {
        return $this->recommandations;
    }

    /**
     * @param mixed $recommandations
     */
    public function setRecommandations($recommandations)
    {
        $this->recommandations = $recommandations;
    }

}
