<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use App\Entity\Enfant;
use App\Form\ListeAffaireType;
use App\Entity\ListeAffaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SejourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date_debut')
            ->add('date_fin')
            ->add('num_ministre')
            ->add('cout')
            /*->add('enfants', CollectionType::class,	['entry_type' => EnfantType::class,
													])*/
            ->add('listeAffaire',EntityType::class, ['class'=>ListeAffaire::class,
													  'choice_label' => 'nomFrancais',
                                                      'expanded'=>false,
                                                      'multiple'=>false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }
}
