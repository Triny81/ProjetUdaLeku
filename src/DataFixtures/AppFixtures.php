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

		// Centre
		$centre1 = new Centre();
		$centre1 -> setVille("Bayonne");
		$manager->persist($centre1);
		
		$centre2 = new Centre();
		$centre2 -> setVille("Ustaritz");
		$manager->persist($centre2);
		
		$centre3 = new Centre();
		$centre3 -> setVille("Biarritz");
		$manager->persist($centre3);
		
		// Etablissement
		$etablissement1 = new Etablissement();
		$etablissement1 -> setNom("Jean Cavailles");
		$etablissement1 -> setVille("Bayonne");
		$manager->persist($etablissement1);
		
		$etablissement2 = new Etablissement();
		$etablissement2 -> setNom("Jules Ferry");
		$etablissement2 -> setVille("Bayonne");
		$manager->persist($etablissement2);

		//DOUBLE BOUCLE, JUSTE POUR VARIER LES ETABLISSEMENT/CENTRES/RESP LAGAUX
          for ($i = 0; $i < 5; $i++)
          {
			// Admin
			$correspondantAdmin = new CorrespondantAdministratif();
			$correspondantAdmin -> setNom($faker -> lastName);
			$correspondantAdmin -> setPrenom($faker -> firstNameMale);
			$correspondantAdmin -> setEmail($faker -> email);
			$correspondantAdmin -> setTelDom($faker -> phoneNumber);
			$correspondantAdmin -> setTelPort($faker -> phoneNumber);
			$correspondantAdmin -> setTelTrav($faker -> phoneNumber);
			$correspondantAdmin -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$correspondantAdmin -> setAideCaf("Une quelconque aide de la CAF");
			$correspondantAdmin -> setAideMsa("Une quelconque aide de la MSA");
			$correspondantAdmin -> setAideAutres("Aucunes autres aides");
			$manager->persist($correspondantAdmin);

			// ResponsableLegal
			$responsableLegal = new ResponsableLegal();
			$responsableLegal -> setNom($faker -> lastName);
			$responsableLegal -> setPrenom($faker -> firstNameMale);
			$responsableLegal -> setEmail($faker -> email);
			$responsableLegal -> setTelDom($faker -> phoneNumber);
			$responsableLegal -> setTelPort($faker -> phoneNumber);
			$responsableLegal -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegal);

			// Enfant  
            $enfant = new Enfant();
			$enfant -> setNom($faker -> lastName);
			$enfant -> setPrenom($faker -> firstNameMale);
			$enfant -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$enfant -> setAdresse1($faker -> address);
			$enfant -> setVille($faker -> city);
			$enfant -> setCodePostal("64100");
			$enfant -> addResponsableLegal($responsableLegal);
			$enfant -> setResponsableLegal($responsableLegal);
			$enfant -> setCorrespondantAdministratif($correspondantAdmin);
			$enfant -> setEtablissement($etablissement1);
			$enfant -> setCentre($centre1);
			
			$manager->persist($enfant);
          }

          for ($i = 0; $i < 5; $i++)
          {
			
			// ResponsableLegal
			$correspondantAdmin = new CorrespondantAdministratif();
			$correspondantAdmin -> setNom($faker -> lastName);
			$correspondantAdmin -> setPrenom($faker -> firstNameMale);
			$correspondantAdmin -> setEmail($faker -> email);
			$correspondantAdmin -> setTelDom($faker -> phoneNumber);
			$correspondantAdmin -> setTelPort($faker -> phoneNumber);
			$correspondantAdmin -> setTelTrav($faker -> phoneNumber);
			$correspondantAdmin -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$correspondantAdmin -> setAideCaf("Une quelconque aide de la CAF");
			$correspondantAdmin -> setAideMsa("Une quelconque aide de la MSA");
			$correspondantAdmin -> setAideAutres("Aucunes autres aides");
			$manager->persist($correspondantAdmin);

			// ResponsableLegal 2
			$responsableLegal2 = new ResponsableLegal();
			$responsableLegal2 -> setNom($faker -> lastName);
			$responsableLegal2 -> setPrenom($faker -> firstNameMale);
			$responsableLegal2 -> setEmail($faker -> email);
			$responsableLegal2 -> setTelDom($faker -> phoneNumber);
			$responsableLegal2 -> setTelPort($faker -> phoneNumber);
			$responsableLegal2 -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegal2);

			// Enfant  
            $enfant = new Enfant();
			$enfant -> setNom($faker -> lastName);
			$enfant -> setPrenom($faker -> firstNameMale);
			$enfant -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$enfant -> setAdresse1($faker -> address);
			$enfant -> setVille($faker -> city);
			$enfant -> setCodePostal("64100");
			$enfant -> setResponsableLegal($responsableLegal2);
			$enfant -> setCorrespondantAdministratif($correspondantAdmin);
			$enfant -> setEtablissement($etablissement2);
			$enfant -> setCentre($centre3);

			$manager->persist($enfant);

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
		$affaire -> setTypeAffaire($typeAffaire);
		$manager->persist($affaire);

		$affaire = new affaire();
		$affaire -> setNomFrancais("Baskets");
		$affaire -> setNomBasque("Basktaxa");
		$affaire -> setTypeAffaire($typeAffaire);
		$manager->persist($affaire);

		$affaire = new affaire();
		$affaire -> setNomFrancais("Une affaire sans type...");
		$affaire -> setNomBasque("Affix sin tyx");
		$affaire -> setTypeAffaire($typeAffaire);
		$manager->persist($affaire);

		//TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Toilette");
		$manager->persist($typeAffaire);

		// Affaire
		$affaire = new affaire();
		$affaire -> setNomFrancais("Serviette");
		$affaire -> setNomBasque("Servetxin");
		$affaire -> setTypeAffaire($typeAffaire);
		$manager->persist($affaire);
		
		//TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Autre");
		$manager->persist($typeAffaire);
		
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
