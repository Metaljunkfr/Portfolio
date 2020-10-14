<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
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
     *@Assert\NotBlank(message="Veuillez renseigner votre nom!")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    /**
     * @var string
     *@Assert\NotBlank(message="Veuillez renseigner votre prénom!")
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse mail!")
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir l'intitulé!")
     * @Assert\Length(
     *      min = 2,
     *      max = 250,
     *      minMessage = "Cet intitulé doit comporter plus de {{ limit }} caractères",
     *      maxMessage = "Cet intitulé doit comporter moins de {{ limit }} caractères"
     * )
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez écrire un message!")
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "Message trop court... Il doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Message trop long... Il doit faire moins de {{ limit }} caractères"
     * )
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    //Getters et setters
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $nom
     *
     * @return Contact
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
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
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subject
     *
     * @param string $objet
     *
     * @return Contact
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}