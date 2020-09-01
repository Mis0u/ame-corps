<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Caroussel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarousselCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Caroussel::class;
    }

    public function configureFields(string $pageName): iterable
    {

        $id = IdField::new('id')->hideOnForm();
        $imageField = ImageField::new('imageFile', 'Image')->setFormType(VichImageType::class)->setHelp("Format jpeg et png <br> Poids Max ~ 500Ko")->setRequired(true);
        $image =  ImageField::new('image', 'Image')->setBasePath("uploads/vich/carousel");
        $date = DateField::new('updatedAt', 'Ajouté le ')->hideOnForm();

        return CRUD::PAGE_INDEX === $pageName || CRUD::PAGE_DETAIL === $pageName ? [$id, $image, $date] : [$id, $imageField, $date];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('dd' . ' ' . 'MMMM' . 'YYYY')
            ->setPageTitle('detail', 'Image')
            ->setPageTitle('index', 'Caroussel')
            ->setPageTitle('edit', 'Modifier l\'image')
            ->setPageTitle('new', 'Ajouter une image');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->setLabel('Ajouter une image');
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
