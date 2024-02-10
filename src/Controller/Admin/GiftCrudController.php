<?php

namespace App\Controller\Admin;

use App\Entity\Gift;
use App\Form\Type\GiftImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gift::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
        yield AssociationField::new('category');
        yield AssociationField::new('age');
        yield CollectionField::new('images')
            ->setEntryType(GiftImagesType::class)
            ->onlyOnForms();
    }

}
