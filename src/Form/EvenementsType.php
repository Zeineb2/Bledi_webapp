<?php

namespace App\Form;

use App\Entity\Evenements;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class EvenementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('dateD')
             ->add('dateF')
              ->add('nom_event')
            ->add('description_event')
            ->add('nbp_event')
            
            
            ->add('categorie_evenet', ChoiceType::class, [
                'label' => 'Choisissez une categorie',
                'choices' => [
                    'ecologique' => 'ecologique',
                    'bb' => 'bb',
                    'cc' => 'cc',
                    'dd' => 'dd',
                ],
            ])
            ->add('image' , FileType::class, array('data_class' => null , 'label'=>"image") )
           
        ;
        
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenements::class,
        ]);
    }
}
