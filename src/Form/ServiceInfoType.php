<?php

namespace App\Form;

use App\Entity\RepairType;
use App\Entity\RepairPlace;
use App\Entity\ServiceInfo;
use App\Entity\VehicleBrand;
use App\Entity\VehicleModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ServiceInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', CustomerType::class)
            ->add('vehicleBrand', EntityType::class, [
                'class' => VehicleBrand::class,
                'choice_label' => 'name',
                'placeholder' => 'Araç markası seçiniz',                
            ])

            ->add('vehicleModel', EntityType::class, [
                'placeholder' => 'Araç modeli seçiniz',
                'class' => VehicleModel::class,
                'choice_label' => 'name',
                'choices' => [],
            ])

            ->add('repairDate', DateTimeType::class, [
                'years' => range(date('y'), 24),
                'months' => range(date('m'), 12),
                'days' => range(1, 30),
                'hours' => range(1, 24),
                'minutes' => range(0, 59,30),
            ])

            ->add('repairType', EntityType::class, [
                'class' => RepairType::class,
                'choice_label' => 'name',
                'placeholder' => 'Tamir türünü seçiniz',
            ])
            ->add('repairPlace', EntityType::class, [
                'placeholder' => 'Tamir yerini seçiniz',
                'class' => RepairPlace::class,
                'choice_label' => 'name',
                'choices' => [],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ServiceInfo::class,
        ]);
    }
    
}
