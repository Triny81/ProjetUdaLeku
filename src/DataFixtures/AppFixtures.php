<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Affaire;
use App\Entity\Centre;
use App\Entity\CorrespondantAdministratif;
use App\Entity\Enfant;
use App\Entity\Etablissement;
use App\Entity\ListeAffaire;
use App\Entity\ResponsableLegal;
use App\Entity\Sejour;
use App\Entity\TypeAffaire;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un générateur de données Faker
          $faker = \Faker\Factory::create('fr_FR');

          for ($i = 0; $i <= 10; $i++)
          {
			// Enfant  
            $enfant = new Enfant();
			$enfant -> setNom($faker -> lastName);
			$enfant -> setPrenom($faker -> firstNameMale);
			$enfant -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$enfant -> setAdresse1($faker -> address);
			$enfant -> setVille($faker -> city);
			$enfant -> setCodePostal("64100");
			
			// ResponsableLegal
			$responsableLegal = new ResponsableLegal();
			$responsableLegal -> setNom($faker -> lastName);
			$responsableLegal -> setPrenom($faker -> firstNameMale);
			$responsableLegal -> setEmail($faker -> email);
			$responsableLegal -> setTelDom($faker -> phoneNumber);
			$responsableLegal -> setTelPort($faker -> phoneNumber);
			$responsableLegal -> setTelTrav($faker -> phoneNumber);
			
			$manager->persist($enfant);
			$manager->persist($responsableLegal);
          }

		 // TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Vêtement");
		$manager->persist($typeAffaire);

		// Moultes Affaires
		$affaire = new affaire();
		$affaire -> setNomFrancais("Lunette");
		$affaire -> setNomBasque("Lunettax");
		$affaire -> setTypeAffaire($typeAffaire);
		$manager -> persist($affaire);

		$affaire = new affaire();
		$affaire -> setNomFrancais("T-shirt");
		$affaire -> setNomBasque("Tix-sharix");
		$manager->persist($affaire);

		$affaire = new affaire();
		$affaire -> setNomFrancais("Baskets");
		$affaire -> setNomBasque("Basktaxa");
		$manager->persist($affaire);

		//TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Toilette");
		$manager->persist($typeAffaire);

		// Affaire
		$affaire = new affaire();
		$affaire -> setNomFrancais("Serviette");
		$affaire -> setNomBasque("Servetxin");
		$manager->persist($affaire);
		
		//TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Autre");
		$manager->persist($typeAffaire);
		
		// Centre
		$centre = new Centre();
		$centre -> setVille("Bayonne");
		$manager->persist($centre);
		
		$centre = new Centre();
		$centre -> setVille("Ustaritz");
		$manager->persist($centre);
		
		$centre = new Centre();
		$centre -> setVille("Biarritz");
		$manager->persist($centre);
		
		// Etablissement
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jean Cavailles");
		$etablissement -> setVille("Bayonne");
		$manager->persist($etablissement);
		
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jules Ferry");
		$etablissement -> setVille("Bayonne");
		$manager->persist($etablissement);
		
		// ListeAffaire
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrancais("Été");
		$listeAffaire -> setNomBasque("???");
		$manager->persist($listeAffaire);
		
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrancais("Hiver");
		$listeAffaire -> setNomBasque("???");
		$manager->persist($listeAffaire);
		
		// Séjour
		$sejour = new Sejour();
		$sejour -> setNom("Cirque");
		$sejour -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 9 weeks', $interval = '+ 5 days', $timezone = null));
		$sejour -> setDateFin($faker->dateTimeInInterval($startDate = '+ 11 weeks', $interval = '+ 5 days', $timezone = null));
		$sejour -> setNumMinistre("123456AX");
		$sejour -> setCout(350);
		$manager->persist($sejour);
		
		$sejour = new Sejour();
		$sejour -> setNom("Equitation");
		$sejour -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 10 weeks', $interval = '+ 5 days', $timezone = null));
		$sejour -> setDateFin($faker->dateTimeInInterval($startDate = '+ 12 weeks', $interval = '+ 5 days', $timezone = null));
		$sejour -> setNumMinistre("123456AX");
		$sejour -> setCout(350);
		$manager->persist($sejour);
		

        $manager->flush();
    }
}
