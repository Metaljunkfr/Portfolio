<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Mise en place formulaire de contact avec les différents champs
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
            ->add('email', EmailType::class, [
            'label' => 'Email : ',
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('objet', TextType::class, [
                'label' => 'Objet : ',
                'attr' => [
                    'placeholder' => 'Objet'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message : ',
                'attr' => [
                    'placeholder' => 'Message'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'user' => null,
        ]);
    }
}
