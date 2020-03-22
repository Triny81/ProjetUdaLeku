<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Form\EnfantType;
use App\Repository\EnfantRepository;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\CorrespondantAdministratif;
use App\Entity\ResponsableLegal;
use App\Entity\Etablissement;

/**
 * @Route("/gestionEnfants")
 */
class EnfantController extends AbstractController
{
    /**
     * @Route("/", name="enfant_index", methods={"GET"})
     */
    public function index(EnfantRepository $enfantRepository): Response
    {
        return $this->render('enfant/index.html.twig', [
            'enfants' => $enfantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creation", name="enfant_creation", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enfant = new Enfant();
        $correspondantAdmin = new CorrespondantAdministratif();
        $enfant->getResponsableLegal()->add($correspondantAdmin);
        $repondableLegal = new ResponsableLegal();
        $enfant->getResponsableLegal()->add($correspondantAdmin);

        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enfant);
            $entityManager->flush();

            return $this->redirectToRoute('enfant_index');
        }

        return $this->render('enfant/new.html.twig', [
            'enfant' => $enfant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/consultation/{id}", name="enfant_consultation", methods={"GET"})
     */
    public function show(Enfant $enfant): Response
    {
        $repEnfant = $this->getDoctrine()->getRepository(Enfant::class);

        $respLegaux = $enfant->getResponsableLegal();
		
		$corrAdmin = $enfant->getCorrespondantAdministratif();

        return $this->render('enfant/show.html.twig', [
            'enfant' => $enfant,
        ]);
    }

    /**
     * @Route("/modification/{id}", name="enfant_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Enfant $enfant): Response
    {
        $manager=$this->getDoctrine()->getManager();

        $form = $this->createForm(EnfantType::class, $enfant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Récupération des formulaires de saisie d'un éventuel nouvel établissement
            $donnees_newEtablissement = $form->getData()->getNewEtablissement();

            if($donnees_newEtablissement != null){
                $new_etablissement = new Etablissement();
                $new_etablissement->setNom($donnees_newEtablissement->getNom());
                $new_etablissement->setVille($donnees_newEtablissement->getVille());

                $manager->persist($new_etablissement);
                $enfant->setEtablissement($new_etablissement);
            }

            $manager->flush();

            return $this->redirectToRoute('enfant_index');
        }

        return $this->render('enfant/edit.html.twig', [
            'enfant' => $enfant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/consultation/{id}", name="enfant_suppression", methods={"DELETE"})
     */
    public function delete(Request $request, Enfant $enfant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enfant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enfant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enfant_index');
    }
}
