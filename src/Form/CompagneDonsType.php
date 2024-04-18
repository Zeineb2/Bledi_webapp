<?php

namespace App\Form;

use App\Entity\CompagneDons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class CompagneDonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_d')
            ->add('date_f')
            ->add('montant_e')
            ->add('descrip')
            ->add('muni',EntityType::class,['class'=>'App\Entity\Municipaties','choice_label'=>'nom_muni',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompagneDons::class,
        ]);
    }
}
