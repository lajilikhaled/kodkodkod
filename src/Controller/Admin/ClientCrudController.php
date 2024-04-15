<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideWhenCreating()->hideOnDetail()->hideWhenUpdating(),
			TextField::new('name'),
			ImageField::new('image', 'Logo Client')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/clients'),
			TextareaField::new('imageFile', 'Logo Client')
				->onlyOnForms()
				->setFormType(VichImageType::class),
		];
	}
}
