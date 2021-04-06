<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\GroupCustomer;
use App\Entity\Klant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroopCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add("customer",EntityType::class,[
                'class'=>Klant::class,
                'choice_label'=>'email'
            ])
            ->add("create",SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupCustomer::class,
        ]);
    }
}
