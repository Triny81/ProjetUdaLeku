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
		
		// ListeAffaire
		$listeEte = new ListeAffaire();
		$listeEte -> setNomFrancais("Été");
		$listeEte -> setNomBasque("???");
		$manager -> persist($listeEte);
		
		$listeHiver = new ListeAffaire();
		$listeHiver -> setNomFrancais("Hiver");
		$listeHiver -> setNomBasque("???");
		$manager -> persist($listeHiver);
						
		// TypeAffaire
		$vetement = new typeAffaire();
		$vetement -> setNom("Vêtement");
		$manager->persist($vetement);
		
		$toilette = new typeAffaire();
		$toilette -> setNom("Toilette");
		$manager->persist($toilette);
		
		$autre = new typeAffaire();
		$autre -> setNom("Autre");
		$manager->persist($autre);
	
		// Moultes Affaires
		
		$tshirt = new affaire();
		$tshirt -> setNomFrancais("T-shirt");
		$tshirt -> setNomBasque("Tix-sharix");
		$tshirt -> setTypeAffaire($vetement);
		$tshirt -> addListeAffaire($listeEte);
		$manager->persist($tshirt);

		$baskets = new affaire();
		$baskets -> setNomFrancais("Baskets");
		$baskets -> setNomBasque("Basktaxa");
		$baskets -> setTypeAffaire($vetement);
		$baskets -> addListeAffaire($listeEte);
		$manager->persist($baskets);
		
		$serviette = new affaire();
		$serviette -> setNomFrancais("Serviette");
		$serviette -> setNomBasque("Servetxin");
		$serviette -> setTypeAffaire($toilette);
		$manager->persist($serviette);
		
		$brosseADent = new affaire();
		$brosseADent -> setNomFrancais("Brosse à dent");
		$brosseADent -> setNomBasque("Brosse à dentxin");
		$brosseADent -> setTypeAffaire($toilette);
		$manager -> persist($brosseADent);
		
		$lunette = new affaire();
		$lunette -> setNomFrancais("Lunette");
		$lunette -> setNomBasque("Lunettax");
		$lunette -> setTypeAffaire($autre);
		$manager -> persist($lunette);
		
		$plancheSurf = new affaire();
		$plancheSurf -> setNomFrancais("Planche de surf");
		$plancheSurf -> setNomBasque("Planche de surfxin");
		$plancheSurf -> setTypeAffaire($autre);
		$manager -> persist($plancheSurf);
		
	
		
		
		// Sejour
		$cirque = new Sejour();
		$cirque -> setNom("Cirque");
		$cirque -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 9 weeks', $interval = '+ 5 days', $timezone = null));
		$cirque -> setDateFin($faker->dateTimeInInterval($startDate = '+ 11 weeks', $interval = '+ 5 days', $timezone = null));
		$cirque -> setNumMinistre("123456AX");
		$cirque -> setCout(350);

					
		$equitation = new Sejour();
		$equitation -> setNom("Equitation");
		$equitation -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 10 weeks', $interval = '+ 5 days', $timezone = null));
		$equitation -> setDateFin($faker->dateTimeInInterval($startDate = '+ 12 weeks', $interval = '+ 5 days', $timezone = null));
		$equitation -> setNumMinistre("123456AX");
		$equitation -> setCout(350);

		
		// Et si on associait les listes aux séjours ?
		$equitation -> setListeAffaire($listeEte);
		$cirque -> setListeAffaire($listeHiver);
		
		$manager->persist($cirque);
		$manager->persist($equitation);

		//DOUBLE BOUCLE, JUSTE POUR VARIER LES ETABLISSEMENT/CENTRES/NOMBRE DE RESP LEGAUX
          for ($i = 0; $i < 5; $i++)
          {
          	// ResponsableLegal
			$responsableLegal = new ResponsableLegal();
			$responsableLegal -> setNom($faker -> lastName);
			$responsableLegal -> setPrenom($faker -> firstNameMale);
			$responsableLegal -> setEmail($faker -> email);
			$responsableLegal -> setTelDom($faker -> phoneNumber);
			$responsableLegal -> setTelPort($faker -> phoneNumber);
			$responsableLegal -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegal);

			// Responsable Legal, qui sera correspondant admin (tout le monde est correspondant légal !)
			$responsableLegalCorresp = new ResponsableLegal();
			$responsableLegalCorresp -> setNom($faker -> lastName);
			$responsableLegalCorresp -> setPrenom($faker -> firstNameMale);
			$responsableLegalCorresp -> setEmail($faker -> email);
			$responsableLegalCorresp -> setTelDom($faker -> phoneNumber);
			$responsableLegalCorresp -> setTelPort($faker -> phoneNumber);
			$responsableLegalCorresp -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegalCorresp);

			// Admin
			$correspondantAdmin = new CorrespondantAdministratif();
			$correspondantAdmin -> setResponsableLegal($responsableLegalCorresp);
			$correspondantAdmin -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$correspondantAdmin -> setAideCaf("Une quelconque aide de la CAF");
			$correspondantAdmin -> setAideMsa("Une quelconque aide de la MSA");
			$correspondantAdmin -> setAideAutres("Aucunes autres aides");
			$manager->persist($correspondantAdmin);

			// Enfant  
            $enfant = new Enfant();
			$enfant -> setNom($faker -> lastName);
			$enfant -> setPrenom($faker -> firstNameMale);
			$enfant -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$enfant -> setAdresse1($faker -> address);
			$enfant -> setVille($faker -> city);
			$enfant -> setCodePostal("64100");
			$enfant -> setResponsableLegal($responsableLegal);
			$enfant -> setCorrespondantAdministratif($correspondantAdmin);
			$enfant -> setEtablissement($etablissement1);
			$enfant -> setCentre($centre1);
			$enfant -> addSejour($cirque);
			
			$manager->persist($enfant);
          }

          for ($i = 0; $i < 5; $i++)
          {
			// Responsable Legal, qui sera correspondant admin
			$responsableLegalCorresp = new ResponsableLegal();
			$responsableLegalCorresp -> setNom($faker -> lastName);
			$responsableLegalCorresp -> setPrenom($faker -> firstNameMale);
			$responsableLegalCorresp -> setEmail($faker -> email);
			$responsableLegalCorresp -> setTelDom($faker -> phoneNumber);
			$responsableLegalCorresp -> setTelPort($faker -> phoneNumber);
			$responsableLegalCorresp -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegalCorresp);

			// Admin
			$correspondantAdmin = new CorrespondantAdministratif();
			$correspondantAdmin -> setResponsableLegal($responsableLegalCorresp);
			$correspondantAdmin -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$correspondantAdmin -> setAideCaf("Une quelconque aide de la CAF");
			$correspondantAdmin -> setAideMsa("Une quelconque aide de la MSA");
			$correspondantAdmin -> setAideAutres("Aucunes autres aides");
			$manager->persist($correspondantAdmin);

			// Enfant  
            $enfant = new Enfant();
			$enfant -> setNom($faker -> lastName);
			$enfant -> setPrenom($faker -> firstNameMale);
			$enfant -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$enfant -> setAdresse1($faker -> address);
			$enfant -> setVille($faker -> city);
			$enfant -> setCodePostal("64100");			

			$enfant -> setCorrespondantAdministratif($correspondantAdmin);
			$enfant -> setEtablissement($etablissement2);
			$enfant -> setCentre($centre3);
			$enfant -> addSejour($equitation);

			$manager->persist($enfant);

          }

         //Imaginons Jean-René le correspondant administratif de Mahmoud qui soit aussi le responsable d'Abdoul !

          // Responsable Legal JEAN-RENÉ, qui sera correspondant admin (tout le monde est correspondant légal !)
			$jeanReneRespLegal = new ResponsableLegal();
			$jeanReneRespLegal -> setNom("Le corresp/responsable");
			$jeanReneRespLegal -> setPrenom("Jean-René");
			$jeanReneRespLegal -> setEmail($faker -> email);
			$jeanReneRespLegal -> setTelDom($faker -> phoneNumber);
			$jeanReneRespLegal -> setTelPort($faker -> phoneNumber);
			$jeanReneRespLegal -> setTelTrav($faker -> phoneNumber);
			$manager->persist($jeanReneRespLegal);

			// Admin JEAN-RENÉ
			$jeanReneCorrespondantAdmin = new CorrespondantAdministratif();
			$jeanReneCorrespondantAdmin -> setResponsableLegal($jeanReneRespLegal);
			$jeanReneCorrespondantAdmin -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$jeanReneCorrespondantAdmin -> setAideCaf("Une quelconque aide de la CAF");
			$jeanReneCorrespondantAdmin -> setAideMsa("Une quelconque aide de la MSA");
			$jeanReneCorrespondantAdmin -> setAideAutres("Aucunes autres aides");
			$manager->persist($jeanReneCorrespondantAdmin);

			// Il lui faut un autre correspondant à Abdoul !
			$responsableLegalCorrespAbdoul = new ResponsableLegal();
			$responsableLegalCorrespAbdoul -> setNom("LUC");
			$responsableLegalCorrespAbdoul -> setPrenom("Le corresp d'abdoul");
			$responsableLegalCorrespAbdoul -> setEmail($faker -> email);
			$responsableLegalCorrespAbdoul -> setTelDom($faker -> phoneNumber);
			$responsableLegalCorrespAbdoul -> setTelPort($faker -> phoneNumber);
			$responsableLegalCorrespAbdoul -> setTelTrav($faker -> phoneNumber);
			$manager->persist($responsableLegalCorrespAbdoul);

			// Admin d'Abdoul
			$correspondantAdminAbdoul = new CorrespondantAdministratif();
			$correspondantAdminAbdoul -> setResponsableLegal($responsableLegalCorrespAbdoul);
			$correspondantAdminAbdoul -> setNumSecu($faker -> numberBetween($min = 100000000000000, $max = 999999999999999));
			$correspondantAdminAbdoul -> setAideCaf("Une quelconque aide de la CAF");
			$correspondantAdminAbdoul -> setAideMsa("Une quelconque aide de la MSA");
			$correspondantAdminAbdoul -> setAideAutres("Aucunes autres aides");
			$manager->persist($correspondantAdminAbdoul);

          // Enfant  abdoul (jean-rené resp)
            $abdoul = new Enfant();
			$abdoul -> setNom($faker -> lastName);
			$abdoul -> setPrenom("Abdoul");
			$abdoul -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$abdoul -> setAdresse1($faker -> address);
			$abdoul -> setVille($faker -> city);
			$abdoul -> setCodePostal("64100");
			$abdoul -> setCorrespondantAdministratif($correspondantAdminAbdoul);
			$abdoul -> setResponsableLegal($jeanReneRespLegal);
			$abdoul -> setEtablissement($etablissement2);
			$abdoul -> setCentre($centre3);
			$manager->persist($abdoul);

			//Enfant mahmoud (jean-rené corresp. admin)
			$mahmoud = new Enfant();
			$mahmoud -> setNom($faker -> lastName);
			$mahmoud -> setPrenom("Mahmoud");
			$mahmoud -> setDateNaiss($faker -> dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null));
			$mahmoud -> setAdresse1($faker -> address);
			$mahmoud -> setVille($faker -> city);
			$mahmoud -> setCodePostal("64100");
			$mahmoud -> setCorrespondantAdministratif($jeanReneCorrespondantAdmin);
			$mahmoud -> setEtablissement($etablissement2);
			$mahmoud -> setCentre($centre3);
			$manager->persist($mahmoud);
				
        $manager->flush();
    }
}