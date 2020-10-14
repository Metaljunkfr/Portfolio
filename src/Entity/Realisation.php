<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @UniqueEntity(fields={"titre"}, message="Ce titre est déjà pris!")
 * @ORM\Entity(repositoryClass="App\Repository\RealisationRepository")
 * @Vich\Uploadable
 */
class Realisation
{
    //Définition des différents champs de la base de données avec caractéristiques
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     *      minMessage = "Description trop courte... Elle doit faire plus de {{ limit }} caractères",
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Veuillez remplir un résumé!")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Résumé trop court... Il doit faire plus de {{ limit }} caractères",
     *     max = 50,
     *      maxMessage = "Résumé trop long... Il doit faire moins de {{ limit }} caractères",
     * )
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagerendu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagecode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagemobile;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagerendu")
     */
    private $imageFilerendu;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagecode")
     */
    private $imageFilecode;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagemobile")
     */
    private $imageFilemobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage1;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage1")
     */
    private $imageFilelangage1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage2;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage2")
     */
    private $imageFilelangage2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage3;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage3")
     */
    private $imageFilelangage3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage4;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage4")
     */
    private $imageFilelangage4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage5;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage5")
     */
    private $imageFilelangage5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage6;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage6")
     */
    private $imageFilelangage6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage7;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage7")
     */
    private $imageFilelangage7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage8;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage8")
     */
    private $imageFilelangage8;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage9;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage9")
     */
    private $imageFilelangage9;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $imagelangage10;

    /**
     * @Vich\UploadableField(mapping="miniature", fileNameProperty="imagelangage10")
     */
    private $imageFilelangage10;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner votre pseudo!")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre pseudo doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Votre pseudo doit faire moins de {{ limit }} caractères"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateProjet;

    //Relation onetomany avec entité CategorieRealisation
    /**
     * @Assert\NotBlank(message="Veuillez choisir une catégorie!")
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieRealisation", inversedBy="realisations")
     */
    private $categorieRealisation;

    //Getters et setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume): void
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
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
    public function getDateProjet()
    {
        return $this->dateProjet;
    }

    /**
     * @param mixed $dateProjet
     */
    public function setDateProjet($dateProjet)
    {
        $this->dateProjet = $dateProjet;
    }

    /**
     * @return mixed
     */
    public function getCategorieRealisation()
    {
        return $this->categorieRealisation;
    }

    /**
     * @param mixed $categorieRealisation
     */
    public function setCategorieRealisation($categorieRealisation)
    {
        $this->categorieRealisation = $categorieRealisation;
    }


    public function setImageFilerendu(File $imageFilerendu = null)
    {
        $this->imageFilerendu = $imageFilerendu;
        if ($imageFilerendu) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilerendu()
    {
        return $this->imageFilerendu;
    }

    public function setImagerendu($imagerendu)
    {
        $this->imagerendu = $imagerendu;
    }

    public function getImagerendu()
    {
        return $this->imagerendu;
    }



    public function setImageFilecode(File $imageFilecode = null)
    {
        $this->imageFilecode = $imageFilecode;
        if ($imageFilecode) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilecode()
    {
        return $this->imageFilecode;
    }

    public function setImagecode($imagecode)
    {
        $this->imagecode = $imagecode;
    }

    public function getImagecode()
    {
        return $this->imagecode;
    }

    public function setImageFilemobile(File $imageFilemobile = null)
    {
        $this->imageFilemobile = $imageFilemobile;
        if ($imageFilemobile) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilemobile()
    {
        return $this->imageFilemobile;
    }

    public function setImagemobile($imagemobile)
    {
        $this->imagemobile = $imagemobile;
    }

    public function getImagemobile()
    {
        return $this->imagemobile;
    }

    public function setImageFilelangage1(File $imageFilelangage1 = null)
    {
        $this->imageFilelangage1 = $imageFilelangage1;
        if ($imageFilelangage1) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage1()
    {
        return $this->imageFilelangage1;
    }

    public function setImagelangage1($imagelangage1)
    {
        $this->imagelangage1 = $imagelangage1;
    }

    public function getImagelangage1()
    {
        return $this->imagelangage1;
    }


    public function setImageFilelangage2(File $imageFilelangage2 = null)
    {
        $this->imageFilelangage2 = $imageFilelangage2;
        if ($imageFilelangage2) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage2()
    {
        return $this->imageFilelangage2;
    }

    public function setImagelangage2($imagelangage2)
    {
        $this->imagelangage2 = $imagelangage2;
    }

    public function getImagelangage2()
    {
        return $this->imagelangage2;
    }


    public function setImageFilelangage3(File $imageFilelangage3 = null)
    {
        $this->imageFilelangage3 = $imageFilelangage3;
        if ($imageFilelangage3) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage3()
    {
        return $this->imageFilelangage3;
    }

    public function setImagelangage3($imagelangage3)
    {
        $this->imagelangage3 = $imagelangage3;
    }

    public function getImagelangage3()
    {
        return $this->imagelangage3;
    }


    public function setImageFilelangage4(File $imageFilelangage4 = null)
    {
        $this->imageFilelangage4 = $imageFilelangage4;
        if ($imageFilelangage4) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage4()
    {
        return $this->imageFilelangage4;
    }

    public function setImagelangage4($imagelangage4)
    {
        $this->imagelangage4 = $imagelangage4;
    }

    public function getImagelangage4()
    {
        return $this->imagelangage4;
    }

    public function setImageFilelangage5(File $imageFilelangage5 = null)
    {
        $this->imageFilelangage5 = $imageFilelangage5;
        if ($imageFilelangage5) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage5()
    {
        return $this->imageFilelangage5;
    }

    public function setImagelangage5($imagelangage5)
    {
        $this->imagelangage5 = $imagelangage5;
    }

    public function getImagelangage5()
    {
        return $this->imagelangage5;
    }

    public function setImageFilelangage6(File $imageFilelangage6 = null)
    {
        $this->imageFilelangage6 = $imageFilelangage6;
        if ($imageFilelangage6) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage6()
    {
        return $this->imageFilelangage6;
    }

    public function setImagelangage6($imagelangage6)
    {
        $this->imagelangage6 = $imagelangage6;
    }

    public function getImagelangage6()
    {
        return $this->imagelangage6;
    }

    public function setImageFilelangage7(File $imageFilelangage7 = null)
    {
        $this->imageFilelangage7 = $imageFilelangage7;
        if ($imageFilelangage7) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage7()
    {
        return $this->imageFilelangage7;
    }

    public function setImagelangage7($imagelangage7)
    {
        $this->imagelangage7 = $imagelangage7;
    }

    public function getImagelangage7()
    {
        return $this->imagelangage7;
    }

    public function setImageFilelangage8(File $imageFilelangage8 = null)
    {
        $this->imageFilelangage8 = $imageFilelangage8;
        if ($imageFilelangage8) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage8()
    {
        return $this->imageFilelangage8;
    }

    public function setImagelangage8($imagelangage8)
    {
        $this->imagelangage8 = $imagelangage8;
    }

    public function getImagelangage8()
    {
        return $this->imagelangage8;
    }

    public function setImageFilelangage9(File $imageFilelangage9 = null)
    {
        $this->imageFilelangage9 = $imageFilelangage9;
        if ($imageFilelangage9) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage9()
    {
        return $this->imageFilelangage9;
    }

    public function setImagelangage9($imagelangage9)
    {
        $this->imagelangage9 = $imagelangage9;
    }

    public function getImagelangage9()
    {
        return $this->imagelangage9;
    }

    public function setImageFilelangage10(File $imageFilelangage10 = null)
    {
        $this->imageFilelangage10 = $imageFilelangage10;
        if ($imageFilelangage10) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFilelangage10()
    {
        return $this->imageFilelangage10;
    }

    public function setImagelangage10($imagelangage10)
    {
        $this->imagelangage10 = $imagelangage10;
    }

    public function getImagelangage10()
    {
        return $this->imagelangage10;
    }
}
