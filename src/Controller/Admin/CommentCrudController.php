<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('Commentaire')
            ->setEntityLabelInPlural('Commentaires')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPageTitle('detail', 'Détails du %entity_label_singular%')
            ->setSearchFields(['id', 'user_name', 'content'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(10);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_INDEX, 'detail')
            ->update(Crud::PAGE_INDEX, 'detail', function (Action $action) {
                return $action->setLabel('Voir');
            })
            ->update(Crud::PAGE_INDEX, 'delete', function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_DETAIL, 'delete', function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_DETAIL, 'index', function (Action $action) {
                return $action->setLabel('Retour à la liste');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('user_name', 'Utilisateur');
        yield TextField::new('content', 'Commentaire');
        // faire method qui récupere le user qui valide le booléan et qui reprend le user connecter
        yield BooleanField::new('is_valid', 'Validé');
        yield AssociationField::new('validator', 'Validé par');
    }
}
