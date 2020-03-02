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
        $nouvelAffaire = new Affaire();
        $form = $this->createForm(AffaireType::class, $nouvelAffaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nouvelAffaire);
            $entityManager->flush();
        }

        return $this->render('affaire/index.html.twig', [
            'affaires' => $affaireRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="affaire_creation", methods={"GET","POST"})
     */
    public function newAffaire(Request $request): Response
    {
        $affaire = new Affaire();
        $form = $this->createForm(AffaireType::class, $affaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($affaire);
            $entityManager->flush();
        }

        return $this->render('affaire/new.html.twig', [
            'affaire' => $affaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="affaire_consultation", methods={"GET"})
     */
    public function showAffaire(Affaire $affaire): Response
    {
        return $this->render('affaire/show.html.twig', [
            'affaire' => $affaire,
        ]);
    }

    /**
     * @Route("/", name="affaire_modification", methods={"GET","POST"})
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
     * @Route("/", name="affaire_suppression", methods={"DELETE"})
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
