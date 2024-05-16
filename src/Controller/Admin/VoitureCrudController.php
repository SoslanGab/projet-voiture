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
use App\Form\ImageVoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class VoitureCrudController extends AbstractCrudController
{

    public function __construct(private SluggerInterface $slugger){

    }
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('marque'),
            TextField::new('modele'),
            AssociationField::new('type'),
            CollectionField::new('imageVoitures', 'Images')
            ->setEntryType(ImageVoitureType::class)
            ->setFormTypeOptions([
                'by_reference' => false, 
                'delete_empty' => true
            ])
            ->onlyOnForms()
        ];
    
        if ($pageName === 'index' || $pageName === 'detail') {
            $fields[] = IdField::new('id');
        }
    
        return $fields;
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        foreach ($entityInstance->getImageVoitures() as $key => $imageVoiture) {
            $file = $imageVoiture->getFile();
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $imageVoiture->setNom($originalFilename);
            $imageVoiture->setExtension($file->guessExtension());
            $imageVoiture->setTaille($file->getSize());
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            $imageVoiture->setUrl('/assets/images/' . $newFilename);

            // Move the file to the directory where brochures are stored
            try {
                $file->move($this->getParameter('image_voiture'), $newFilename);
            } catch (FileException $e) {
                
                // ... handle exception if something happens during file upload
            }
        }
        $entityManager->persist($entityInstance);
        $entityManager->flush();
        
    }
}
