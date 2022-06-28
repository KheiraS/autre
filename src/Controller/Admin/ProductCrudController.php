<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public const PRODUCTS_BASE_PATH ='images/uploads/product';
    public const PRODUCTS_UPLOAD_DIR ='public/images/uploads/product';

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom du produit'),
            AssociationField::new('brand')->setLabel('Marque'),
            AssociationField::new('category')->setLabel('Catégorie'),
            TextEditorField::new('description'),
            MoneyField::new('price')
                ->setLabel('Prix')
                ->setCurrency('EUR'),
            ImageField::new('image')
                ->setLabel('Image principale')
                ->setBasePath(self::PRODUCTS_BASE_PATH)
                ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
                ->setSortable(false),
            BooleanField::new('available')->setLabel('En stock'),
            IntegerField::new('rate')->setLabel('Évaluation'),
            BooleanField::new('offer')->setLabel('Offre Promotionnelle'),

        ];
    }

}
