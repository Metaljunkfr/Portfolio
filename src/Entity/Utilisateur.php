<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_user")
 * @UniqueEntity(fields={"email"}, message="Cet email a déjà été enregistré!")
 * @UniqueEntity(fields={"pseudo"}, message="Ce pseudo n'est pas disponible!")
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    //Définition des différents champs de la base de données avec caractéristiques
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@Assert\Length(
     *      min = 4,
     *      max = 25,
     *      minMessage = "Votre pseudo doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Votre pseudo doit faire moins de {{ limit }} caractères"
     * )
     * @Assert\Regex(pattern="/^[a-z0-9_-]+$/i", message="Votre pseudo doit comporter seulement des lettres, des chiffres, et les caractères underscore et points!")
     * @Assert\NotBlank(message="Veuillez renseigner un pseudo!")
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @Assert\Email(message="Votre adresse mail n'est pas valide!")
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse mail!")
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @Assert\Length(
     *      min = 8,
     *      max = 4096,
     *      minMessage = "Votre mot de passe doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre mot de passe doit faire moins de {{ limit }} caractères"
     * )
     * @Assert\NotBlank(message="Veuillez renseigner un mot de passe!")
     * @ORM\Column(type="string", length=64)
     */
    private $motdepasse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="roles", type="string")
     */
    private $roles;

    //Relation OnetoMany avec entité Recommandation
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recommandation", mappedBy="utilisateur", cascade={"remove"})
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
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param mixed $motdepasse
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
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
    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(string $roles)
    {
        if ($roles === null) {
            $this->roles = "ROLE_USER";
        } else {

        $this->roles = $roles;
        }
        return $this;
    }

    //Inutile...
    public function getSalt()
    {
        return null;
    }

    //Inutile...
    public function eraseCredentials()
    {

    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->motdepasse;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->pseudo;
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
