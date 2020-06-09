<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Doctrine\ORM\EntityRepository;

use App\Entity\Enfant;
use App\Entity\Affaire;
use App\Entity\ListeAffaire;

use App\Form\ListeAffaireType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SejourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date_debut', DateType::class, [
                'empty_data' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'],
                'years'=> range(date('Y'), date('Y')+10),
                'format' => 'dd MM yyyy'])
            ->add('date_fin', DateType::class, [
                'empty_data' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'],
                'years'=> range(date('Y'), date('Y')+10),
                'format' => 'dd MM yyyy'])
            ->add('num_ministre')
            ->add('cout')
            ->add('listeAffaire', EntityType::class, ['class'=>ListeAffaire::class,
													  'choice_label' => 'nom_francais',
                                                      'expanded'=>false,
                                                      'multiple'=>false, ]) 
			->add('enfants', EntityType::class, ['class'=>Enfant::class,
												  'choice_label' => function($enfants)
												  { 
													  return $enfants -> getNom()." ".$enfants -> getPrenom();
												  },
												  'query_builder' => function (EntityRepository $entityRepo ) 
													{
														return $entityRepo->createQueryBuilder('e')
																->orderBy('e.nom', 'ASC');
													},
												  'expanded'=>true,
												  'multiple'=>true,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }

}
