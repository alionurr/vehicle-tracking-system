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
                    'placeholder' => 'Adınız'
                ],
            ])
            ->add('surname', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Soyadınız'
                ],
           ])
            ->add('phoneNumber', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Telefon Numaranız'
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
