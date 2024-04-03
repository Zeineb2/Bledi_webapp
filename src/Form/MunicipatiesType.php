<?php

namespace App\Form;

use App\Entity\Municipaties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MunicipatiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMuni')
            ->add('adresseMuni')
            ->add('etatMuni')
            ->add('ratingMuni')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Municipaties::class,
        ]);
    }
}
