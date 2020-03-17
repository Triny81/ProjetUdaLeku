<?php

namespace App\Form;

use App\Entity\CorrespondantAdministratif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CorrespondantAdministratifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel_dom')
            ->add('tel_port')
            ->add('tel_trav')
            ->add('num_secu')
            ->add('aide_caf')
            ->add('aide_msa')
            ->add('aide_autres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CorrespondantAdministratif::class,
        ]);
    }
}
