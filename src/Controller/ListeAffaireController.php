<?php

namespace App\Controller;

use App\Entity\ListeAffaire;
use App\Form\ListeAffaire1Type;
use App\Repository\ListeAffaireRepository;

use App\Entity\Affaire;
use App\Form\AffaireType;
use App\Repository\AffaireRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
* @Route("/listeAffaire")
*/
class ListeAffaireController extends AbstractController
{
  /**
  * @Route("/", name="liste_affaire_index", methods={"GET","POST"})
  */
  public function index(ListeAffaireRepository $listeAffaireRepository, Request $request): Response
  {
    //Implémentation du formulaire de création d'une liste d'affaire
    $nouvelleListeAffaire = new ListeAffaire();
    $formCreate = $this->createForm(ListeAffaire1Type::class, $nouvelleListeAffaire);
    $formCreate->handleRequest($request);

    return $this->render('liste_affaire/index.html.twig', [
      'liste_affaires' => $listeAffaireRepository->findAll(),
      'form' => $formCreate->createView(),
    ]);
  }

  /**
  * @Route("/creation", name="liste_affaire_creation", methods={"GET","POST"})
  */
  public function new(Request $request, ValidatorInterface $validator): Response
  {
    $listeAffaire = new ListeAffaire();
    $form = $this->createForm(ListeAffaire1Type::class, $listeAffaire);
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
      if($form->isValid())
      {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($listeAffaire);
        $entityManager->flush();

        $this->addFlash('success', 'La liste '.$form->getData()->getNomFrancais().' a été créée avec succès !');
      }

    }
    else{
      $errors = $validator->validate($form->getData());

      foreach ($errors as $error) {
        $this->addFlash('error', $error->getMessage());
      }
    }

    return $this->render('liste_affaire/new.html.twig', [
      'liste_affaire' => $listeAffaire,
      'form' => $form->createView(),
    ]);
    //return $this->redirectToRoute('liste_affaire_index');
  }

  /**
  * @Route("/consultation{id}", name="liste_affaire_consultation", methods={"GET","POST"})
  */
  public function show(ListeAffaire $listeAffaire, ListeAffaireRepository $listeAffaireRepository): Response
  {
    return $this->render('liste_affaire/show.html.twig', [
      'liste_affaire' => $listeAffaire,
    ]);
  }

  /**
  * @Route("/modification/{id}", name="liste_affaire_modification", methods={"GET","POST"})
  */
  public function edit(Request $request, ListeAffaire $listeAffaire, AffaireRepository $affaireRepository): Response
  {
    $form = $this->createForm(ListeAffaire1Type::class, $listeAffaire);
    $form->handleRequest($request);
    $toutesLesAffaires = $affaireRepository->findAll();

    if ($form->isSubmitted() && $form->isValid())
      {

        $donnees_listeAffaire = $form->getData();

        foreach($toutesLesAffaires as $affaire)
        {
          if($donnees_listeAffaire -> getAffaire() -> contains($affaire))
          {
            $affaire -> addListeAffaire($listeAffaire);
          }
          else
          {
            $affaire -> removeListeAffaire($listeAffaire);
          }

        }

        $this->getDoctrine()->getManager()->persist($donnees_listeAffaire);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('liste_affaire_index');
    }

    return $this->render('liste_affaire/edit.html.twig', [
      'liste_affaire' => $listeAffaire,
      'form' => $form->createView(),
      'affaires' => $toutesLesAffaires,
    ]);
  }

  /**
  * @Route("suppression/{id}", name="liste_affaire_suppression", methods={"DELETE"})
  */
  public function delete(Request $request, ListeAffaire $listeAffaire): Response
  {
    if ($this->isCsrfTokenValid('delete'.$listeAffaire->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($listeAffaire);
      $entityManager->flush();
    }

    return $this->redirectToRoute('liste_affaire_index');
  }
}
