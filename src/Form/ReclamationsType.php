<?php

namespace App\Form;

use App\Entity\Reclamations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ReclamationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localisationRec')
            ->add('descriptionRec')
            ->add('imgRec',FileType::class, array('data_class' => null,'required' => false))
            ->add('status')
            ->add('cinCit')
            
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamations::class,
        ]);
    }
}
