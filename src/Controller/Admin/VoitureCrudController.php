<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\CollectionType;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('marque'),
            TextField::new('modele'),
            AssociationField::new('type'),
            CollectionField::new('imageVoitures')
                ->setEntryType(ImageVoitureType::class) 
                ->onlyOnForms(), 
        ];
    
        if ($pageName === 'index' || $pageName === 'detail') {
            $fields[] = IdField::new('id');
        }
    
        return $fields;
    } 

}
