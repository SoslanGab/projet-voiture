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
        foreach ($entityInstance->getImageVoitures() as $imageVoiture) {
            $file = $imageVoiture->getFile();
            if ($file) {
                // Vérifiez si le fichier temporaire existe avant de le manipuler
                if (!file_exists($file->getPathname())) {
                    throw new \Exception('Le fichier temporaire n\'existe pas ou n\'est pas lisible.');
                }

                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Déplacez le fichier vers le répertoire de destination
                try {
                    $file->move($this->getParameter('image_voiture'), $newFilename);
                } catch (FileException $e) {
                    throw new \Exception('Erreur lors du déplacement du fichier: ' . $e->getMessage());
                }

                $imageVoiture->setUrl('/assets/images/voitures' . $newFilename);
                $imageVoiture->setNom($originalFilename);
                $imageVoiture->setExtension($file->guessExtension());
                $imageVoiture->setTaille($file->getSize());
            }
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}

