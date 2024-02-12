<?php

namespace App\Controller\Admin;

use App\Entity\Reindeers;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReindeersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reindeers::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextareaField::new('story');
        yield TextField::new('file')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield ImageField::new('file_name')
            ->onlyOnIndex()
            ->setBasePath('/uploads/reindeers/')
            ->setUploadDir('public/uploads/reindeers/');
    }
}
