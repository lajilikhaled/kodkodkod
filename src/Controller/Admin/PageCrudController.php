<?php

namespace App\Controller\Admin;

use App\Admin\GrapeField;
use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideWhenCreating()->hideOnDetail()->hideWhenUpdating(),
			TextField::new('title'),
			TextField::new('metaTitle'),
			TextField::new('metaDescription'),
			TextField::new('slug'),
			TextField::new('locale'),


		];
	}
}
