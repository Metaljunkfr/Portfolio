<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;use Symfony\Component\Form\Extension\Core\Type\PasswordType;use Symfony\Component\Form\Extension\Core\Type\RepeatedType;use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Mise en place formulaire d'inscription avec les différents champs
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Choisissez un pseudo : ',
                'attr' => [
                             'placeholder' => 'Pseudo'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom : ',
                'required' => false,
                'attr' => [
                             'placeholder' => 'Nom (facultatif)'
                 ]
             ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom : ',
                'required' => false,
                'attr' => [
                             'placeholder' => 'Prénom (facultatif)'
                ]
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Les courriels doivent correspondre!',
                'required' => false,
                'first_options'  => ['label' => 'Saisissez votre Email : ',
                'attr' => [
                             'placeholder' => 'Email'
                ]],
                'second_options' => ['label' => 'Confirmez l\'email : ',
                'attr' => [
                             'placeholder' => 'Répéter Email'
                ]],
            ])

            ->add('motdepasse', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre!',
                'required' => false,
                'first_options'  => ['label' => 'Mot de passe : ',
                'attr' => [
                             'placeholder' => 'Mot de passe'
                ]],
                'second_options' => ['label' => 'Répétez le mot de passe : ',
                'attr' => [
                             'placeholder' => 'Répéter Mot de passe'
                ]],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
