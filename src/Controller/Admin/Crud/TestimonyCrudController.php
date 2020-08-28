<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Testimony;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use App\Controller\Admin\Crud\Services\ListConstTitle;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use App\Controller\Admin\Crud\Helper\CrudConstructorTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class TestimonyCrudController extends AbstractCrudController
{
    use CrudConstructorTrait;

    public static function getEntityFqcn(): string
    {
        return Testimony::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('name', 'Nom'),
            TextEditorField::new('content', 'Contenu du commentaire')->setFormType(CKEditorType::class)->setFormTypeOptions(['config' => ['toolbar' => 'full']]),
            DateTimeField::new('createdAt', 'Créé le ')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $this->configureCrud->setTitle($crud, ListConstTitle::COMMENT_DETAIL, ListConstTitle::COMMENT_INDEX, ListConstTitle::COMMENT_EDIT, ListConstTitle::COMMENT_NEW);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->setLabel('Ajouter un témoignage');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel(false);
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pencil-alt')->setLabel(false);
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel(false);
            });
    }
}
