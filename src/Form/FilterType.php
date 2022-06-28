<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function __construct(CategoryRepository $categoryRepository,BrandRepository $brandRepository){
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $categParent = $options['idCategParent'];
        $builder
            //Filter by Sub Categories
                ->add('sous-categories', EntityType::class,[
                    'required'=>false,
                'query_builder'=>function(EntityRepository $er) use ($categParent) {
                    return $er->createQueryBuilder('c')
                        ->where('c.parent = :idCategParent')
                        ->setParameter('idCategParent', $categParent);
                },
                'class'=>Category::class,
                'attr'=>['class'=>'form-control mb-3 rounded-pill'],
                'label'=>'Catégories'
            ])

            //Filter by Brand
            ->add('brand', EntityType::class, [
                'required'=>false,
                'choices'=> $this->brandRepository->findAll(),
                'class' => Brand::class,
                'attr'=>['class'=>'form-control mb-3 rounded-pill'],
                'label'=>'Marque'
            ])

            //Filter by rate
            ->add('rate', ChoiceType::class, [
                'choices'=> [
                    '1'=> 1,
                    '2'=> 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5
                ],
                'choice_attr' => [
                    '1' => ['class'=>'ms-2 me-1'],
                    '2' => ['class' => 'ms-2 me-1'],
                    '3' => ['class' => 'ms-2 me-1'],
                    '4' => ['class' => 'ms-2 me-1'],
                    '5' => ['class' => 'ms-2 me-1'],
                ],

                'expanded'=>true,
                'multiple'=>true,
                'label'=>'Note'
            ])

            //Filter by price
            ->add('priceMin', NumberType::class,
            [
                'required'=>false,
                'attr'=>[
                    'class'=>'form-control mb-3 rounded-pill'
                ],
                'label'=>'Prix mini'
            ])
            ->add('priceMax', NumberType::class,
                [
                    'required'=>false,
                    'attr'=>[
                        'class'=>'form-control mb-3 rounded-pill'
                    ],
                    'label'=>'Prix maxi'
                ])

            //Submit button
            ->add('Appliquer', SubmitType::class, [
                'attr'=>[
                    'class'=> 'btn-blue'
                ]
            ])
            ->setMethod('GET')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'idCategParent'=>0,
            'csrf_protection'=>false,
        ]);
    }
}
