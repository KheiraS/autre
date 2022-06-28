<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BrandCrudController extends AbstractCrudController
{
    public const BRANDS_BASE_PATH ='images/uploads/brand';
    public const BRANDS_UPLOAD_DIR ='public/images/uploads/brand';

    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom de la marque'),
            ImageField::new('logo')
                ->setBasePath(self::BRANDS_BASE_PATH)
                ->setUploadDir(self::BRANDS_UPLOAD_DIR),
        ];
    }

}
