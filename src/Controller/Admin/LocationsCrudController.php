<?php

// src/Controller/Admin/LocationsCrudController.php

namespace App\Controller\Admin;

use App\Entity\Locations;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LocationsCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Locations::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('voiture'),
            AssociationField::new('client'),
            DateField::new('date_de_debut'),
            DateField::new('date_de_fin'),
            MoneyField::new('total_paiement')->setCurrency('EUR'),
            ChoiceField::new('status')->setChoices([
                'En attente' => 'en attente',
                'Confirmée' => 'confirmée',
            ]),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $confirm = Action::new('confirm', 'Confirmer la location')
            ->linkToCrudAction('confirmLocation')
            ->addCssClass('btn btn-success')
            ->displayIf(function (Locations $entity) {
                return $entity->getStatus() !== 'confirmée';
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $confirm)
            ->add(Crud::PAGE_DETAIL, $confirm);
    }

    public function confirmLocation(AdminContext $context): RedirectResponse
    {
        $location = $context->getEntity()->getInstance();
        $location->setStatus('confirmée');
        $this->entityManager->flush();

        $this->addFlash('success', 'La location a été confirmée avec succès.');

        // Rediriger vers la liste des locations
        return $this->redirect($this->generateUrl('app_admin'));
    }
}






