<?php


namespace App\Form;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\VoitureRepository;

class ContactType extends AbstractType
{

    private $voitureRepository;

    public function __construct(VoitureRepository $voitureRepository)
    {
        $this->voitureRepository = $voitureRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $voitures = $this->voitureRepository->findAll();
        $builder
            ->add('name', TextType::class, ['label' => 'Votre Nom'])
            ->add('mail', EmailType::class, ['label' => 'Votre E-mail'])
            ->add('voiture_choisi', ChoiceType::class, [
                'label' => 'Choisissez une voiture',
                'choices' => $voitures,
                'choice_label' => function (Voiture $voiture) {
                    return $voiture->getMarque() . ' ' . $voiture->getModele();
                },
                'placeholder' => '--choisissez une voiture--',
            ])
            ->add('subject', TextType::class, ['label' => 'Sujet'])
            ->add('message', TextareaType::class, ['label' => 'Message'])
            ->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'voiture_choices' => []
        ]);
    }
}
