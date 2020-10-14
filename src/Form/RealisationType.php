<?php

namespace App\Form;

use App\Entity\Realisation;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Mise en place formulaire d'ajout réalisation avec les différents champs
        $builder
            ->add('auteur', TextType::class, [
                'label' => 'Votre pseudo : ',
                'attr' => [
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre de votre réalisation : ',
                'attr' => [
                    'placeholder' => 'Titre projet'
                ]
            ])
            ->add('categorieRealisation', null, [
                    'label' => 'Catégorie de réalisation : ',
                    'choice_label' => 'nom',
                    'placeholder' => 'Choisissez ...']
            )
            ->add('dateProjet', DateType::class, [
                'label' => 'Date de réalisation du projet : ',
                'widget' => 'choice'
            ])
            ->add('imageFilerendu', FileType::class, [
                'label' => 'Image rendu',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilecode', FileType::class, [
                'label' => 'Image code',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Extrait code'
                ]
            ])
            ->add('imageFilemobile', FileType::class, [
                'label' => 'Image mobile',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Responsive'
                ]
            ])
            ->add('resume', TextType::class, [
                'label' => 'Résumé : ',
                'attr' => [
                    'placeholder' => 'Résumé'
                ]
            ])
            ->add('imageFilelangage1', FileType::class, [
                'label' => 'Image langage 1',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage2', FileType::class, [
                'label' => 'Image langage 2',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage3', FileType::class, [
                'label' => 'Image langage 3',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage4', FileType::class, [
                'label' => 'Image langage 4',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage5', FileType::class, [
                'label' => 'Image langage 5',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage6', FileType::class, [
                'label' => 'Image langage 6',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage7', FileType::class, [
                'label' => 'Image langage 7',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage8', FileType::class, [
                'label' => 'Image langage 8',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage9', FileType::class, [
                'label' => 'Image langage 9',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('imageFilelangage10', FileType::class, [
                'label' => 'Image langage 10',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Miniature'
                ]
            ])
            ->add('description', CKEditorType::class,[
                'label' => 'Décrivez votre réalisation : ',
                'attr' => [
                    'class' => 'description-txt',
                    'placeholder' => 'Description'
                ]
            ]);

        $builder->get('description')->resetViewTransformers();
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
