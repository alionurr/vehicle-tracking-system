<?php

namespace App\Form;

use App\Entity\ServiceInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customerId')
            ->add('vehicleBrand')
            ->add('vehicleModel')
            ->add('repairType')
            ->add('repairPlace')
            ->add('repairDate')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ServiceInfo::class,
        ]);
    }
}
