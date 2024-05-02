<?php

namespace App\Form;

use App\Entity\Evenements;

use App\Entity\Evenement;
use App\Entity\Reservations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ReservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('evenementss',EntityType::class,  [
                'class' => Evenements::class,
                'choice_label' => 'nom_event',
            ])
            ->add('CIN_cit')
            ->add('commentaire')
            
            
            

        ;
         ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
