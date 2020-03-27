<?php

namespace App\Form;

use App\Entity\CorrespondantAdministratif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\ResponsableLegal;

class CorrespondantAdministratifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('responsable_legal',EntityType::class,
                                                    ['class'=>ResponsableLegal::class,
                                                    'choice_label' => function ($responsable_legal) {
                                                             return $responsable_legal->getNom()." ".$responsable_legal->getPrenom();
                                                     },
                                                    'expanded'=>false,
                                                    'multiple'=>false,
                                                    'query_builder' => function (EntityRepository $entityRepo ) {
                                                            return $entityRepo->createQueryBuilder('e')        
                                                                    ->orderBy('e.nom', 'ASC');
                                                        }
                                                    ],)
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
