<?php

namespace App\Controller;

use App\Entity\Affaire;
use App\Form\AffaireType;
use App\Repository\AffaireRepository;

use App\Entity\TypeAffaire;
use App\Form\TypeAffaireType;
use App\Repository\TypeAffaireRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/gestionAffaires")
 */
class AffaireController extends AbstractController
{
    /**
     * @Route("/", name="affaire_index", methods={"GET"})
     */
    public function index(AffaireRepository $affaireRepository, Request $request): Response
    {
        //Cette fonction index créé une affaire avant même que l'utilisateur ne l'ait demandé, c'est qui n'est pas optimisé
    
        //Implémentation du formulaire de création d'une affaire
        $nouvelleAffaire = new Affaire();
        $formCreate = $this->createForm(AffaireType::class, $nouvelleAffaire);
        $formCreate->handleRequest($request);

        $toutesLesAffaires = $affaireRepository->findAll();

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($affaire);
            $entityManager->flush();
        }

        return $this->render('affaire/index.html.twig', [
            'affaires' => $toutesLesAffaires,
            'formCreate' => $formCreate->createView(),
        ]);
    }

    /**
     * @Route("/", name="affaire_creation", methods={"GET","POST"})
     */
    public function newAffaire(Request $request): Response
    {//TODO : Supprimer cette action;, ou enlever cette action déjà présente dans l'action métier de la route index.
    //Elle a été mise deux fois pour des raisons de simplicités (pour afficher le formulaire lors du chargement de l'index)
        $affaire = new Affaire();
        $form = $this->createForm(AffaireType::class, $affaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($affaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affaire_index');
        
    }

    /**
     * @Route("/modification/{id}", name="affaire_modification", methods={"GET","POST"})
     */
    public function editAffaire(Request $request, Affaire $affaire): Response
    {
        $form = $this->createForm(AffaireType::class, $affaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affaire_index');            
        }

        return $this->render('affaire/edit.html.twig', [
            'affaire' => $affaire,
            'form' => $form->createView(),
        ]);

        
    }

    /**
     * @Route("/modification/{id}", name="affaire_suppression", methods={"DELETE"})
     */
    public function deleteAffaire(Request $request, Affaire $affaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($affaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affaire_index');
    }

    /**
     * @Route("/", name="type_affaire_creation", methods={"GET","POST"})
     */
    public function newTAffaire(Request $request): Response
    {
        $typeAffaire = new TypeAffaire();
        $form = $this->createForm(TypeAffaireType::class, $typeAffaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeAffaire);
            $entityManager->flush();

            return $this->redirectToRoute('affaire_index');
        }

        return $this->render('type_affaire/new.html.twig', [
            'type_affaire' => $typeAffaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="type_affaire_modification", methods={"GET","POST"})
     */
    public function editTAffaire(Request $request, TypeAffaire $typeAffaire): Response
    {
        $form = $this->createForm(TypeAffaireType::class, $typeAffaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_affaire_index');
        }

        return $this->render('type_affaire/edit.html.twig', [
            'type_affaire' => $typeAffaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="type_affaire_suppression", methods={"DELETE"})
     */
    public function deleteTAffaire(Request $request, TypeAffaire $typeAffaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeAffaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeAffaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_affaire_index');
    }
}
