<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Vliegtuig;
use App\Entity\Vliegveld;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DatumVlucht')
            ->add('vliegtuigID',EntityType::class,[
                'class'=>Vliegtuig::class,
                'choice_label'=>'model'
            ])
            ->add('vertrekVliegveldId',EntityType::class,[
                'class'=>Vliegveld::class,
                'choice_label'=>'naam'
            ])
            ->add('eindVliegveldId',EntityType::class,[
                'class'=>Vliegveld::class,
                'choice_label'=>'naam'
            ])
            ->add("create",SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
