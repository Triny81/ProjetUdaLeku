<?php

namespace App\Form;

use App\Entity\Enfant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Etablissement;
use App\Entity\ResponsableLegal;
use App\Entity\Centre;
use App\Entity\Sejour;


class EnfantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naiss')
            ->add('remarque')
            ->add('adresse_1')
            ->add('adresse_2')
            ->add('ville')
            ->add('code_postal')
            ->add('responsable_legal',EntityType::class, ['class'=>ResponsableLegal::class,
                                                    'choice_label' => function ($responsable_legal) {
                                                             return $responsable_legal->getNom()." ".$responsable_legal->getPrenom();
                                                     },
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
            ->add('etablissement',EntityType::class, ['class'=>Etablissement::class,
                                                    'choice_label'=>'nom',
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
            ->add('centre',EntityType::class, ['class'=>Centre::class,
                                                    'choice_label'=>'ville',
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
            ->add('sejour',EntityType::class, ['class'=>Sejour::class,
                                                    'choice_label' => function ($sejour) {
                                                             return $sejour->getNom()." (du ".$sejour->getDateDebut()->format("d/m/Y")." au ".$sejour->getDateFin()->format("d/m/Y").")";
                                                     },
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enfant::class,
        ]);
    }
}
