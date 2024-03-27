<?php

namespace App\Form;

use App\Entity\Solutions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolutionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descriptionSol')
            ->add('datedSol')
            ->add('datefSol')
            ->add('etatSol')
            ->add('budgetSol')
            ->add('idRec')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Solutions::class,
        ]);
    }
}
