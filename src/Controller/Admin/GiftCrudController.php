<?php

namespace App\Controller\Admin;

use App\Entity\Gift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
    }

}
