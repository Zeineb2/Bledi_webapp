<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('cin')
            ->add('email')
            ->add('tel')
            ->add('adresse')
            ->add('rate')
            ->add('pwd')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Citoyen' => 'ROLE_CITOYEN',
                    'Agent municipal' => 'ROLE_AGENT',
                ],
                'required' => true,
                'placeholder' => 'Choisir un rôle',
            ])
            ->add('posteAg')
            ->add('idMuni')
            ->add('isVerified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
