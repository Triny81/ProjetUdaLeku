<?php

namespace App\Form;

use App\Entity\Affaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypeAffaire;

class AffaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_francais')
            ->add('nom_basque')
            ->add('type_affaire',EntityType::class, ['class'=>TypeAffaire::class,
                                                    'choice_label'=>'nom',
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affaire::class,
        ]);
    }
}
