<?php

namespace App\Form;

use App\Entity\ListeAffaire;
use App\Entity\Affaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeAffaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_francais')
            ->add('nom_basque')
            ->add('affaire', EntityType::class, ['class'=>Affaire::class,
													  'choice_label' => 'nom_francais',
                                                      'expanded'=>false,
                                                      'multiple'=>false, ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListeAffaire::class,
        ]);
    }
}
