<?php

namespace App\Controller\Admin\Crud\Actuality;

use App\Entity\Actuality\Actuality;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use App\Controller\Admin\Crud\Services\ListConstTitle;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use App\Controller\Admin\Crud\Helper\CrudConstructorTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActualityCrudController extends AbstractCrudController
{
    use CrudConstructorTrait;

    public static function getEntityFqcn(): string
    {
        return Actuality::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id')->hideOnForm();
        $title = TextField::new('title', 'Titre');
        $imageField = ImageField::new('imageFile', 'Image')->setFormType(VichImageType::class,)->setHelp("Format jpg et png <br> Poids Max ~ 500Ko");
        $image = ImageField::new('imageFile', 'Image')->setBasePath('/uploads/vich/actuality');
        $content = TextEditorField::new('content', 'Contenu')->setFormType(CKEditorType::class);
        $date = DateTimeField::new('createdAt', 'Créé le ')->hideOnForm();
        $association = AssociationField::new('actualityComments', 'Commentaires')->hideOnForm();

        if (CRUD::PAGE_INDEX === $pageName || CRUD::PAGE_DETAIL === $pageName) {
            return [$id, $title, $imageField, $content, $date, $association];
        } elseif (CRUD::PAGE_NEW === $pageName) {
            return [$id, $title, $imageField->setRequired(true), $content, $date, $association];
        } else {
            return  [$id, $title, $imageField, $content, $date, $association];
        }
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $this->configureCrud->setTitle($crud, ListConstTitle::ACTU_DETAIL, ListConstTitle::ACTU_INDEX, ListConstTitle::ACTU_EDIT, ListConstTitle::ACTU_NEW);
    }


    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->setLabel('Créer un article');
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
