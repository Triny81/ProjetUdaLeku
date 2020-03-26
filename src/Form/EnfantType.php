<?php

namespace App\Form;

use App\Entity\Enfant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Etablissement;
use App\Entity\ResponsableLegal;
use App\Entity\CorrespondantAdministratif;
use App\Entity\Centre;
use App\Entity\Sejour;

use App\Form\EtablissementType;
use App\Form\ResponsableLegalType;
use App\Form\CorrespondantAdministratifType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class EnfantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $options['entity_manager'];

        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naiss', DateType::class, [
                'empty_data' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'],
                'years'=> range(date('Y')-20, date('Y')),
                'format' => 'dd MM yyyy'])
            ->add('remarque')
            ->add('adresse_1')
            ->add('adresse_2')
            ->add('ville')
            ->add('code_postal')
            ->add('correspondant_administratif',EntityType::class,
                                                    ['class'=>CorrespondantAdministratif::class,
                                                    'choice_label' => function ($correspondant_administratif) {
                                                             return $correspondant_administratif->getResponsableLegal()->getNom()." ".$correspondant_administratif->getResponsableLegal()->getPrenom();
                                                     },
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
            ->add('responsable_legal',EntityType::class,
                                                    ['class'=>ResponsableLegal::class,
                                                    'choice_label' => function ($responsable_legal) {
                                                             return $responsable_legal->getNom()." ".$responsable_legal->getPrenom();
                                                     },
                                                    'expanded'=>false,
                                                    'multiple'=>false,
                                                    'required'=>false,
                                                    'placeholder'=>'Aucun(e)',
                                                    /*'query_builder' => function (EntityRepository $entityRepo ) {
                                                            return $entityRepo->createQueryBuilder('resp')
                                                                    ->orderBy('resp.nom', 'DESC');
                                                        }*/
                                                    ],)
            ->add('new_responsableLegal',ResponsableLegalType::class,['required'=>false,
                                                            ])
            ->add('etablissement',EntityType::class, ['class'=>Etablissement::class,
                                                    'choice_label'=>'nom',
                                                    'expanded'=>false,
                                                    'multiple'=>false,
                                                    'required'=>false,
                                                    'placeholder'=>'Aucun',])
            ->add('new_etablissement',EtablissementType::class,['required'=>false,
                                                            ])
            ->add('centre',EntityType::class, ['class'=>Centre::class,
                                                    'choice_label'=>'ville',
                                                    'expanded'=>false,
                                                    'multiple'=>false,])
            ->add('sejour',EntityType::class, ['class'=>Sejour::class,
                                                    'choice_label' => function ($sejour) {
                                                             return $sejour->getNom()." (du ".$sejour->getDateDebut()->format("d/m/Y")." au ".$sejour->getDateFin()->format("d/m/Y").")";
                                                     },
                                                    'expanded'=>true,
                                                    'multiple'=>true,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enfant::class,
        ])
        ->setRequired('entity_manager');
    }
}
