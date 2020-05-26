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

/**
 * @Route("/listeAffaire")
 */
class ListeAffaireController extends AbstractController
{
    /**
     * @Route("/", name="liste_affaire_index", methods={"GET"})
     */
    public function index(ListeAffaireRepository $listeAffaireRepository, Request $request): Response
    {
      //Implémentation du formulaire de création d'une liste d'affaire
      $nouvelleListeAffaire = new ListeAffaire();
      $formCreate = $this->createForm(ListeAffaire1Type::class, $nouvelleListeAffaire);
      $formCreate->handleRequest($request);

        return $this->render('liste_affaire/index.html.twig', [
            'liste_affaires' => $listeAffaireRepository->findAll(),
            'formCreate' => $formCreate->createView(),
        ]);
    }

    /**
     * @Route("/creation", name="liste_affaire_creation", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listeAffaire = new ListeAffaire();
        $form = $this->createForm(ListeAffaire1Type::class, $listeAffaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listeAffaire);
            $entityManager->flush();

            return $this->redirectToRoute('liste_affaire_index');
        }

        return $this->render('liste_affaire/new.html.twig', [
            'liste_affaire' => $listeAffaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/consultation{id}", name="liste_affaire_consultation", methods={"GET"})
     */
    public function show(ListeAffaire $listeAffaire): Response
    {
        return $this->render('liste_affaire/show.html.twig', [
            'liste_affaire' => $listeAffaire,
        ]);
    }

    /**
     * @Route("/modification/{id}", name="liste_affaire_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, ListeAffaire $listeAffaire): Response
    {
        $form = $this->createForm(ListeAffaire1Type::class, $listeAffaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_affaire_index');
        }

        return $this->render('liste_affaire/edit.html.twig', [
            'liste_affaire' => $listeAffaire,
            'form' => $form->createView(),
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
