<?php

namespace App\Controller\Admin\Crud\Services;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;



class ConfigureCrud
{
    public function setTitle($crud, string $detail, string $index, string $edit, string $new, string $dateTime = 'dd MMMM YYYY')
    {
        return $crud
            ->setDateTimeFormat($dateTime)
            ->setPageTitle('detail', $detail)
            ->setPageTitle('index', $index)
            ->setPageTitle('edit', $edit)
            ->setPageTitle('new', $new)
            ->addFormTheme("@FOSCKEditor/Form/ckeditor_widget.html.twig")

    }

    public function setSimpleCrud()
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('content', 'Contenu de l\'article')->setFormType(CKEditorType::class)->setFormTypeOptions(['config_name' => 'my_config']),
        ];
    }

    public function setButtonArticle($actions)
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
