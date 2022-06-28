<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Civilité*',
                'choices' => [
                    'Mme' => true,
                    'M.' => false,
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Nom*'
            ])
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Prénom*'
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Adresse*'
            ])
            ->add('postcode', TextType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Code postal*'
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label' => 'Ville*'
            ])
            //Submit button
            ->add('Modifier', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-blue'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
