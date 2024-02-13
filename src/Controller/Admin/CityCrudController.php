<?php

namespace App\Controller\Admin;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('department', 'Département');
        yield TextField::new('name', 'Nom de la ville');
        yield TextField::new('zip_code', 'Code postal');
    }
    
}
