<?php

namespace App\Controller\Admin;

use App\Entity\ImageVoiture;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImageVoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageVoiture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id')->onlyOnIndex(),
            // TextField::new('nom', 'Nom de l\'image'),
            // UrlField::new('url', 'URL de l\'image'),
            // TextField::new('type', 'Type de l\'image'),
            // TextField::new('taille', 'Taille de l\'image'),
            // TextField::new('extension', 'Extension de l\'image'),
            ImageField::new('file', 'image')
                ->setUploadDir('public/assets/images/voitures')
                ->setFormTypeOption('mapped', false), // Désactive l'AssetMapper
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
       
    }
}

