<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
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
	        DateTimeField::new('posted'),
	        ImageField::new('image', 'Image')
		        ->onlyOnIndex()
		        ->setFormType(VichImageType::class)
		        ->setBasePath('/images/blog'),
	        TextareaField::new('imageFile', 'Image')
		        ->onlyOnForms()
		        ->setFormType(VichImageType::class),
            TextareaField::new('description')->setFormType(CKEditorType::class)->hideOnIndex(),
        ];
    }
	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
			;
	}
}
