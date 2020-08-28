<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use App\Controller\Admin\Crud\Services\ListConstTitle;
use App\Controller\Admin\Crud\Helper\CrudConstructorTrait;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    use CrudConstructorTrait;

    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return $this->configureCrud->setSimpleCrud();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $this->configureCrud->setTitle($crud, ListConstTitle::ARTICLE_DETAIL, ListConstTitle::ARTICLE_INDEX, ListConstTitle::ARTICLE_EDIT, ListConstTitle::ARTICLE_NEW);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $this->configureCrud->setButtonArticle($actions);
    }
}
