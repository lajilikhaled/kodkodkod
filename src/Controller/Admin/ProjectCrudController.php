<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
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
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Project Title'),
            TextField::new('slug', 'Slug'),
            TextareaField::new('description', 'Description'),
            TextareaField::new('descriptionKo', 'Description (Korean)'),
            TextareaField::new('descriptionEn', 'Description (English)'),
            TextField::new('country', 'Country'),
            NumberField::new('priority', 'Priority'),
            NumberField::new('priorityKo', 'Priority (Korean)'),

            ArrayField::new('technology', 'Technologies'),
            ArrayField::new('ecommerce', 'E-Commerce'),
            ArrayField::new('blockchain', 'Blockchain'),

			TextField::new('title4Fr', 'Title 4 (FR)'),
			TextField::new('title4En', 'Title 4 (EN)'),
			TextField::new('title4Ko', 'Title 4 (KO)'),
			
			TextareaField::new('text4Fr', 'Text 4 (FR)'),
			TextareaField::new('text4En', 'Text 4 (EN)'),
			TextareaField::new('text4Ko', 'Text 4 (KO)'),
			
			TextField::new('title5Fr', 'Title 5 (FR)'),
			TextField::new('title5En', 'Title 5 (EN)'),
			TextField::new('title5Ko', 'Title 5 (KO)'),
			
			TextareaField::new('text5Fr', 'Text 5 (FR)'),
			TextareaField::new('text5En', 'Text 5 (EN)'),
			TextareaField::new('text5Ko', 'Text 5 (KO)'),
			
			TextField::new('title6Fr', 'Title 6 (FR)'),
			TextField::new('title6En', 'Title 6 (EN)'),
			TextField::new('title6Ko', 'Title 6 (KO)'),
			
			TextareaField::new('text6Fr', 'Text 6 (FR)'),
			TextareaField::new('text6En', 'Text 6 (EN)'),
			TextareaField::new('text6Ko', 'Text 6 (KO)'),
			
			TextField::new('title7Fr', 'Title 7 (FR)'),
			TextField::new('title7En', 'Title 7 (EN)'),
			TextField::new('title7Ko', 'Title 7 (KO)'),
			
			TextareaField::new('text7Fr', 'Text 7 (FR)'),
			TextareaField::new('text7En', 'Text 7 (EN)'),
			TextareaField::new('text7Ko', 'Text 7 (KO)'),
			
			TextField::new('title8Fr', 'Title 8 (FR)'),
			TextField::new('title8En', 'Title 8 (EN)'),
			TextField::new('title8Ko', 'Title 8 (KO)'),
			
			TextareaField::new('text8Fr', 'Text 8 (FR)'),
			TextareaField::new('text8En', 'Text 8 (EN)'),
			TextareaField::new('text8Ko', 'Text 8 (KO)'),
			
			TextareaField::new('text9Fr', 'Text 9 (FR)'),
			TextareaField::new('text9En', 'Text 9 (EN)'),
			TextareaField::new('text9Ko', 'Text 9 (KO)'),
			

            TextField::new('color1', 'Color 1'),
            TextField::new('color2', 'Color 2'),
            TextField::new('color3', 'Color 3'),
            TextField::new('color4', 'Color 4'),
            TextField::new('color5', 'Color 5'),

            TextareaField::new('goal', 'Goal'),

            ImageField::new('image', 'Image Header')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('imageFile', 'Image Header File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            // Slide 1 Images
            ImageField::new('slideOneImageLeft', 'Slide 1 - Left')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideOneImageLeftFile', 'Slide 1 - Left File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideOneImageRight', 'Slide 1 - Right')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideOneImageRightFile', 'Slide 1 - Right File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideOneImageCenter', 'Slide 1 - Center')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideOneImageCenterFile', 'Slide 1 - Center File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            // Slide 2 Images
            ImageField::new('slideTwoImageLeft', 'Slide 2 - Left')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideTwoImageLeftFile', 'Slide 2 - Left File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideTwoImageRight', 'Slide 2 - Right')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideTwoImageRightFile', 'Slide 2 - Right File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            // Slide 3 Images
            ImageField::new('slideThreeImage1Left', 'Slide 3 - Image 1 Left')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideThreeImage1LeftFile', 'Slide 3 - Image 1 Left File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideThreeImage2Right', 'Slide 3 - Image 2 Right')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideThreeImage2RightFile', 'Slide 3 - Image 2 Right File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideThreeImage3Left', 'Slide 3 - Image 3 Left')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideThreeImage3LeftFile', 'Slide 3 - Image 3 Left File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('slideThreeImage4Right', 'Slide 3 - Image 4 Right')
                ->setBasePath('/images/projects')
                ->onlyOnIndex(),
            TextareaField::new('slideThreeImage4RightFile', 'Slide 3 - Image 4 Right File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            AssociationField::new('category', 'Category'),
        ];
    }
}
