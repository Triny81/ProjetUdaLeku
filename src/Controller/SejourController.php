<?php

namespace App\Controller;

use App\Entity\Sejour;
use App\Form\SejourType;
use App\Repository\SejourRepository;

use App\Entity\Enfant;
use App\Form\EnfantType;
use App\Repository\EnfantRepository;

use App\Entity\ListeAffaire;
use App\Form\ListeAffaireType;
use App\Repository\ListeAffaireRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/gestionSejours")
*/
class SejourController extends AbstractController
{
  /**
  * @Route("/", name="sejour_index", methods={"GET"})
  */
  public function index(SejourRepository $sejourRepository): Response
  {
    return $this->render('sejour/index.html.twig', [
      'sejours' => $sejourRepository->findAll(),
    ]);
  }

  /**
  * @Route("/creation", name="sejour_creation", methods={"GET","POST"})
  */
  public function new(Request $request, ListeAffaireRepository $listeAffaireRepository, EnfantRepository $enfantRepository): Response
  {
    $sejour = new Sejour();
    $form = $this->createForm(SejourType::class, $sejour);
    $form->handleRequest($request);
	
	$listeEnfant = $enfantRepository -> findAll();

    if ($form->isSubmitted() && $form->isValid()) 
	{
		$donnees_sejour = $form->getData();

	  foreach($listeEnfant as $enfant)
	  {
		if($donnees_sejour -> getEnfants() -> contains($enfant) )
		{
			$enfant -> addSejour($sejour);
		}
		else
		{
			$enfant -> removeSejour($sejour);
		}
	  }
		
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($sejour);
      $entityManager->flush();

      return $this->redirectToRoute('sejour_index');
    }

    return $this->render('sejour/new.html.twig', [
      'sejour' => $sejour,
      'listeAffaire' => $listeAffaireRepository -> findAll(),
      'form' => $form->createView(),
    ]);
  }

  /**
  * @Route("/consultation/{id}", name="sejour_consultation", methods={"GET"})
  */
  public function show(Sejour $sejour): Response
  {
    return $this->render('sejour/show.html.twig', [
      'sejour' => $sejour,
    ]);
  }

  // DEBUT
  /**
  * @Route("/modification/{id}", name="sejour_modification", methods={"GET","POST"})
  */
  public function edit(Request $request, Sejour $sejour, ListeAffaireRepository $listeAffaireRepository, EnfantRepository $enfantRepository): Response
  {
	$form = $this->createForm(SejourType::class, $sejour);
	$form->handleRequest($request);

	$listeEnfant = $enfantRepository -> findAll();
	/*dump( $listeAffaireRepository -> findAll() );
	exit();*/
	if ($form->isSubmitted() && $form->isValid() )
	{
	  $donnees_sejour = $form->getData();

	  foreach($listeEnfant as $enfant)
	  {
		if($donnees_sejour -> getEnfants() -> contains($enfant) )
		{
			$enfant -> addSejour($sejour);
		}
		else
		{
			$enfant -> removeSejour($sejour);
		}
	  }

	$this->getDoctrine()->getManager()->persist($donnees_sejour);
	$this->getDoctrine()->getManager()->flush();

	$this->addFlash('success', "Le séjour ".$donnees_sejour->getNom()." a été modifié avec succès !");

	return $this->redirectToRoute('sejour_index');
	}

	return $this->render('sejour/edit.html.twig', [
	'sejour' => $sejour,
	'listeAffaire' => $listeAffaireRepository -> findAll(),
	'form' => $form->createView(),
	]);
}


/**
* @Route("/consultation/{id}", name="sejour_suppression", methods={"DELETE"})
*/
public function delete(Request $request, Sejour $sejour): Response
{
  if ($this->isCsrfTokenValid('delete'.$sejour->getId(), $request->request->get('_token'))) {
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($sejour);
    $entityManager->flush();
  }

  return $this->redirectToRoute('sejour_index');
}
}
