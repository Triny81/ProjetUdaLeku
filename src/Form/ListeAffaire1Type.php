<?php

namespace App\Form;

use App\Entity\ListeAffaire;
use App\Entity\Affaire;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeAffaire1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_francais')
            ->add('nom_basque')
            ->add('affaire', EntityType::class, ['class'=>Affaire::class,
													  'choice_label' => 'nom_francais',
                                                      'expanded'=>true,
                                                      'multiple'=>true, ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListeAffaire::class,
        ]);
    }
}
