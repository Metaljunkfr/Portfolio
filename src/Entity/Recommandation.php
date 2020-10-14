<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields={"titre"}, message="Ce titre est déjà pris!")
 * @ORM\Entity(repositoryClass="App\Repository\RecommandationRepository")
 */
class Recommandation
{
    //Définition des différents champs de la base de données avec caractéristiques
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir votre nom!")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    /**
     * @var string
     *  @Assert\NotBlank(message="Veuillez remplir votre prénom!")
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @Assert\NotBlank(message="Veuillez remplir l'intitulé!")
     * @Assert\Length(
     *      min = 2,
     *      max = 250,
     *      minMessage = "Cet intitulé doit comporter plus de {{ limit }} caractères",
     *      maxMessage = "Cet intitulé doit comporter moins de {{ limit }} caractères"
     * )
     * @ORM\Column(type="string", length=250, unique=true)
     */
    private $titre;

    /**
     * @Assert\NotBlank(message="Veuillez remplir une description!")
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "Description trop courte... Elle doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Description trop longue... Elle doit faire moins de {{ limit }} caractères"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    //Relation ManytoOne avec entité CategorieRecommandation
    /**
     * @Assert\NotBlank(message="Veuillez choisir une catégorie!")
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieRecommandation", inversedBy="recommandations")
     */
    private $categorieRecommandation;

    //Relation ManytoOne avec entité Utilisateur
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="recommandations", cascade={"persist"})
     */
    private $utilisateur;

    //Getters et setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getCategorieRecommandation()
    {
        return $this->categorieRecommandation;
    }

    /**
     * @param mixed $categorieRecommandation
     */
    public function setCategorieRecommandation($categorieRecommandation)
    {
        $this->categorieRecommandation = $categorieRecommandation;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }
}
