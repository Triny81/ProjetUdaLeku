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

		$centre3 = new Centre();
		$centre3 -> setVille("Hendaye");
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
	
						
		// TypeAffaire
		$vetement = new TypeAffaire();
		$vetement -> setNom("Vêtement");
		$manager->persist($vetement);
		
		$toilette = new TypeAffaire();
		$toilette -> setNom("Toilette");
		$manager->persist($toilette);
		
		$autre = new TypeAffaire();
		$autre -> setNom("Autre");
		$manager->persist($autre);
	
		// Moultes Affaires
		$tshirt = new Affaire();
		$tshirt -> setNomFrancais("T-shirt");
		$tshirt -> setNomBasque("Tix-sharix");
		$tshirt -> setTypeAffaire($vetement);
		$manager->persist($tshirt);

		$baskets = new Affaire();
		$baskets -> setNomFrancais("Baskets");
		$baskets -> setNomBasque("Basktaxa");
		$baskets -> setTypeAffaire($vetement);
		$manager->persist($baskets);
		
		$serviette = new Affaire();
		$serviette -> setNomFrancais("Serviette");
		$serviette -> setNomBasque("Servetxin");
		$serviette -> setTypeAffaire($toilette);
		$manager->persist($serviette);
		
		$brosseADent = new Affaire();
		$brosseADent -> setNomFrancais("Brosse à dent");
		$brosseADent -> setNomBasque("Brosse à dentxin");
		$brosseADent -> setTypeAffaire($toilette);
		$manager -> persist($brosseADent);
		
		$lunette = new Affaire();
		$lunette -> setNomFrancais("Lunettes de soleil");
		$lunette -> setNomBasque("Lunettax");
		$lunette -> setTypeAffaire($autre);
		$manager -> persist($lunette);
		
		$maillot = new Affaire();
		$maillot -> setNomFrancais("Maillot de bain");
		$maillot -> setNomBasque("Maillotxin");
		$maillot -> setTypeAffaire($vetement);
		$manager -> persist($maillot);

		$doudoune = new Affaire();
		$doudoune -> setNomFrancais("Doudoune");
		$doudoune -> setNomBasque("Doudounea");
		$doudoune -> setTypeAffaire($vetement);
		$manager -> persist($doudoune);

		$chassure = new Affaire();
		$chassure -> setNomFrancais("Chaussures de randonnée");
		$chassure -> setNomBasque("Chassurix randonnax");
		$chassure -> setTypeAffaire($vetement);
		$manager -> persist($chassure);

		$combi = new Affaire();
		$combi -> setNomFrancais("Combinaison de ski");
		$combi -> setNomBasque("Combinaison de skitxin");
		$combi -> setTypeAffaire($vetement);
		$manager -> persist($combi);
		
	
		// ListeAffaire
		$listeEte = new ListeAffaire();
		$listeEte -> setNomFrancais("Été");
		$listeEte -> setNomBasque("Etax");
		$listeEte -> addAffaire($lunette);
		$listeEte -> addAffaire($baskets);
		$listeEte -> addAffaire($serviette);
		$listeEte -> addAffaire($maillot);
		$listeEte -> addAffaire($brosseADent);
		$listeEte -> addAffaire($serviette);
		$manager -> persist($listeEte);
		
		$listeHiver = new ListeAffaire();
		$listeHiver -> setNomFrancais("Hiver");
		$listeHiver -> setNomBasque("Hiverax");
		$listeHiver -> addAffaire($combi);
		$listeHiver -> addAffaire($chassure);
		$listeHiver -> addAffaire($doudoune);
		$listeHiver -> addAffaire($brosseADent);
		$listeHiver -> addAffaire($serviette);
		$listeHiver -> addAffaire($lunette);
		$manager -> persist($listeHiver);
		
		// Sejour
		$sej_ski = new Sejour();
		$sej_ski -> setNom("Ski");
		$sej_ski -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 9 weeks', $interval = '+ 5 days', $timezone = null));
		$sej_ski -> setDateFin($faker->dateTimeInInterval($startDate = '+ 11 weeks', $interval = '+ 5 days', $timezone = null));
		$sej_ski -> setNumMinistre("123456AX");
		$sej_ski -> setCout(350);

					
		$sej_ete = new Sejour();
		$sej_ete -> setNom("Vacances d'été");
		$sej_ete -> setDateDebut($faker->dateTimeInInterval($startDate = '+ 10 weeks', $interval = '+ 5 days', $timezone = null));
		$sej_ete -> setDateFin($faker->dateTimeInInterval($startDate = '+ 12 weeks', $interval = '+ 5 days', $timezone = null));
		$sej_ete -> setNumMinistre("123456AX");
		$sej_ete -> setCout(290);

		
		// Et si on associait les listes aux séjours ?
		$sej_ete -> setListeAffaire($listeEte);
		$sej_ski -> setListeAffaire($listeHiver);
		
		$manager->persist($sej_ski);
		$manager->persist($sej_ete);

		//DOUBLE BOUCLE, JUSTE POUR VARIER LES SEJOURS/ETABLISSEMENT/CENTRES/NOMBRE DE RESP LEGAUX
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

			$enfant -> addSejour($sej_ski);
			
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

			$enfant -> addSejour($sej_ete);


			$manager->persist($enfant);

          }

          //Vérification de l'héritage des correspondants et des responsables
         //Imaginons Jean-René le correspondant administratif de Mahmoud qui soit aussi le responsable d'Abdoul !

          // Responsable Legal JEAN-RENÉ, qui sera aussi correspondant admin
			$jeanReneRespLegal = new ResponsableLegal();
			$jeanReneRespLegal -> setNom("Le CorrespResponsable");
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
			$responsableLegalCorrespAbdoul -> setNom("Le corresp d'abdoul");
			$responsableLegalCorrespAbdoul -> setPrenom("Philippe");
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
			$abdoul -> addSejour($sej_ski);

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
			$mahmoud -> addSejour($sej_ski);

			$manager->persist($mahmoud);

        $manager->flush();
    }
}