<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\EntityFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideWhenUpdating()->hideWhenCreating(),
			TextField::new('title'),
			TextField::new('description'),
			TextField::new('descriptionKo'),
			TextField::new('descriptionEn'),
			TextField::new('country'),
			NumberField::new('priority'),
			NumberField::new('priorityKo'),

			ArrayField::new('technology'),

			ImageField::new('image', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('imageFile', 'Image header')
				->onlyOnForms()
				->setFormType(VichImageType::class),

			ImageField::new('slideOneImageLeft', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideOneImageLeftFile', 'Image slide On Left')
				->onlyOnForms()
				->setFormType(VichImageType::class),

			ImageField::new('slideOneImageRight', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideOneImageRightFile', 'Image slide One Right')
				->onlyOnForms()
				->setFormType(VichImageType::class),

			ImageField::new('slideOneImageCenter', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideOneImageCenterFile', 'Image slide One Center')
				->onlyOnForms()
				->setFormType(VichImageType::class),

				ImageField::new('slideTwoImageLeft', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideTwoImageLeftFile', 'Image slide On Left')
				->onlyOnForms()
				->setFormType(VichImageType::class),
				ImageField::new('slideTwoImageRight', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideTwoImageRightFile', 'Image slide On Right')
				->onlyOnForms()
				->setFormType(VichImageType::class),
				ImageField::new('slideThreeImage1Left', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideThreeImage1LeftFile', 'Image slide Three Image1 Left')
				->onlyOnForms()
				->setFormType(VichImageType::class),
			ImageField::new('slideThreeImage2Right', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideThreeImage2RightFile', 'Image slide Three Image2 Right')
				->onlyOnForms()
				->setFormType(VichImageType::class),

				ImageField::new('slideThreeImage3Left', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideThreeImage3LeftFile', 'Image slide Three Image 3 Left')
				->onlyOnForms()
				->setFormType(VichImageType::class),

				ImageField::new('slideThreeImage4Right', 'Image')
				->onlyOnIndex()
				->setFormType(VichImageType::class)
				->setBasePath('/images/projects'),
			TextareaField::new('slideThreeImage4RightFile', 'Image slide Three Image4 Right')
				->onlyOnForms()
				->setFormType(VichImageType::class),


			AssociationField::new('category'),
			TextField::new('slug'),
		];
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
