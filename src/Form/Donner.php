<?php

namespace App\Form;

use App\Entity\Dons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Donner extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant_don')
            ->add('mail_don')
            ->add('CIN_don')
            ->add('virement_img')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([            'data_class' => Dons::class,
        ]);
    }
}
