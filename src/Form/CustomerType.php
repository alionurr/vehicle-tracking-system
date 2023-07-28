<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Customer Name'
                        ],
                   ])
            ->add('surname', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Customer Surname'
                ],
           ])
            ->add('phoneNumber', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Customer Phone Number'
                ],
           ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
