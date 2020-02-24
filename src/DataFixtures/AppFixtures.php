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
			$enfant -> setDateNaiss($faker -> birthNumber);
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
			
			$manager->persist(Enfant);
			$manager->persist(ResponsableLegal);
          }
		  
		 
		// Affaire
		$affaire = new affaire();
		$affaire -> setNomFrançais("Lunette");
		$affaire -> setNomBasque("???");
		$manager->persist(Affaire);
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("T-shirt");
		$affaire -> setNomBasque("???");
		$manager->persist(Affaire);
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("short");
		$affaire -> setNomBasque("???");
		$manager->persist(Affaire);
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("basket");
		$affaire -> setNomBasque("???");
		$manager->persist(Affaire);
		
		// Centre
		$centre = new Centre();
		$centre -> setVille("Bayonne");
		$manager->persist(Centre);
		
		$centre = new Centre();
		$centre -> setVille("Ustaritz");
		$manager->persist(Centre);
		
		$centre = new Centre();
		$centre -> setVille("Biarritz");
		$manager->persist(Centre);
		
		// Etablissement
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jean Cavailles");
		$etablissement -> setVille("Bayonne");
		$manager->persist(Etablissement);
		
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jules Ferry");
		$etablissement -> setVille("Bayonne");
		$manager->persist(Etablissement);
		
		// ListeAffaire
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrançais("Été");
		$listeAffaire -> setNomBasque("???");
		$manager->persist(ListeAffaire);
		
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrançais("Hiver");
		$listeAffaire -> setNomBasque("???");
		$manager->persist(ListeAffaire);
		
		// Séjour
		$sejour = new Sejour();
		$sejour -> setNom("Cirque");
		$sejour -> setDateDebut("12/12/12");
		$sejour -> setDateFin("20/12/12");
		$sejour -> setN°Ministre("123456AX");
		$sejour -> setCout(350);
		$manager->persist(Sejour);
		
		$sejour = new Sejour();
		$sejour -> setNom("Equitation");
		$sejour -> setDateDebut("12/12/12");
		$sejour -> setDateFin("20/12/12");
		$sejour -> setN°Ministre("123456AX");
		$sejour -> setCout(350);
		$manager->persist(Sejour);
		
		// TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Vêtement");
		$manager->persist(TypeAffaire);
		
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Toilette");
		$manager->persist(TypeAffaire);
		
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Autre");
		$manager->persist(TypeAffaire);

        $manager->flush();
    }
}
