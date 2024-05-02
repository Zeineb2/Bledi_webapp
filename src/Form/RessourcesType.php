<?php

namespace App\Form;

use App\Entity\Ressources;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RessourcesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IDMuni')
            ->add('nomRessource')
            ->add('nbrRessource')
            ->add('imageFile', FileType::class, [
                'label' => 'Resource Image',
                'required' => false, // To allow submitting the form without selecting an image
                'mapped' => false, // Not mapped to any property since VichUploader handles it
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}