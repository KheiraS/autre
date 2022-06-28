<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Adresse e-mail*'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control mb-3 rounded-pill'
                ],

                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label'=>'Créer un mot de passe*',
            ])
            ->add('gender',ChoiceType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Civilité*',
                'choices' => [
                    'Mme' => true,
                    'M.' => false,
                ],
            ])
            ->add('lastname',TextType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Nom*'
            ])
            ->add('firstname',TextType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Prénom*'
            ])
            ->add('address',TextType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Adresse*'
            ])
            ->add('postcode',TextType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Code postal*'
            ])
            ->add('city',TextType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Ville*'
            ])
            ->add('dateBirth', BirthdayType::class,[
                'attr' => ['class' => 'form-control mb-3 rounded-pill'],
                'label'=>'Date de naissance*'
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
