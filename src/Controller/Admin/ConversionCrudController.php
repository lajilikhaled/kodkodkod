<?php

namespace App\Controller\Admin;

use App\Entity\Conversion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConversionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conversion::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
