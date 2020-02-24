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
          }
		  
		 
		// Affaire
		$affaire = new affaire();
		$affaire -> setNomFrançais("Lunette");
		$affaire -> setNomBasque("???");
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("T-shirt");
		$affaire -> setNomBasque("???");
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("short");
		$affaire -> setNomBasque("???");
		
		$affaire = new affaire();
		$affaire -> setNomFrançais("basket");
		$affaire -> setNomBasque("???");
		
		// Centre
		$centre = new Centre();
		$centre -> setVille("Bayonne");
		
		$centre = new Centre();
		$centre -> setVille("Ustaritz");
		
		$centre = new Centre();
		$centre -> setVille("Biarritz");
		
		// Etablissement
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jean Cavailles");
		$etablissement -> setVille("Bayonne");
		
		$etablissement = new Etablissement();
		$etablissement -> setNom("Jules Ferry");
		$etablissement -> setVille("Bayonne");
		
		// ListeAffaire
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrançais("Été");
		$listeAffaire -> setNomBasque("???");
		
		$listeAffaire = new ListeAffaire();
		$listeAffaire -> setNomFrançais("Hiver");
		$listeAffaire -> setNomBasque("???");
		
		// Séjour
		$sejour = new Sejour();
		$sejour -> setNom("Cirque");
		$sejour -> setDateDebut("12/12/12");
		$sejour -> setDateFin("20/12/12");
		$sejour -> setN°Ministre("123456AX");
		$sejour -> setCout(350);
		
		$sejour = new Sejour();
		$sejour -> setNom("Equitation");
		$sejour -> setDateDebut("12/12/12");
		$sejour -> setDateFin("20/12/12");
		$sejour -> setN°Ministre("123456AX");
		$sejour -> setCout(350);
		
		// TypeAffaire
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Vêtement");
		
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Toilette");
		
		$typeAffaire = new typeAffaire();
		$typeAffaire -> setNom("Autre");

        $manager->flush();
    }
}
