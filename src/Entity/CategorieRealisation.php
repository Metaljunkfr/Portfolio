<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRealisationRepository")
 */
class CategorieRealisation
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

    //Relation onetomany avec entité Realisation
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Realisation", mappedBy="categorieRealisation", cascade={"remove"})
     */
    private $realisations;

    public function __construct()
    {
        $this->realisations = new ArrayCollection();
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
    public function getRealisations()
    {
        return $this->realisations;
    }

    /**
     * @param mixed $realisations
     */
    public function setRealisations($realisations)
    {
        $this->realisations = $realisations;
    }

}
