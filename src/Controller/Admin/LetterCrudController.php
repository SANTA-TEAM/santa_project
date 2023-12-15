<?php

namespace App\Controller\Admin;

use App\Entity\Letter;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LetterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Letter::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');
        yield TextareaField::new('text', 'Texte');
        yield AssociationField::new('writer', 'Auteur');
        yield AssociationField::new('gift', 'Cadeau');
    }

}
