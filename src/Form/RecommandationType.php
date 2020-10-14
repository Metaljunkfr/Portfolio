<?php

namespace App\Form;

use App\Entity\Recommandation;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecommandationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //Mise en place formulaire d'ajout recommandation avec les différents champs
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom : ',
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom : ',
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre de votre recommandation : ',
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Décrivez votre recommandation : ',
                'attr' => [
                    'class' => 'description-txt',
					'placeholder' => 'Recommanderiez-vous Guillaume professionnellement?'
                ]
            ])

            ->add('categorieRecommandation', null, [
                    'label' => 'Note : ',
                    'choice_label' => 'nom',
                'placeholder' => 'Choisissez ...']
                );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recommandation::class,
            'user' => null,
        ]);
    }
}
