<?php

namespace App\Controller\Admin;

use App\Entity\Reindeers;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
        yield TextField::new('file_name');
        yield ImageField::new('file_name')
        ->setBasePath('/uploads/reindeers/')
        ->setUploadDir('public/uploads/reindeers/');
    }

}
