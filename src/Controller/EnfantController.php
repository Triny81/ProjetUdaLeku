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

use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function new(Request $request, ValidatorInterface $validator): Response
    {
        $enfant = new Enfant();

        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();

                $donnes_enfant = $form->getData();
                //Récupération des données formulaires de saisie d'un éventuel nouvel établissement/correspondant administratif/responsable légal
                $donnees_newEtablissement = $donnes_enfant->getNewEtablissement();
                $donnees_newRespLegal = $donnes_enfant->getNewResponsableLegal();
                $donnees_newCorrespAdmin = $donnes_enfant->getNewCorrespondantAdministratif();

                if($donnees_newEtablissement != null){
                    $this->enregistrerNouvelEtablissement($donnees_newEtablissement, $enfant);
                }

                //Enregistrement de l'éventuel nouveau établissement
                if($donnees_newRespLegal != null){
                    $this->enregisterNouveauResp($donnees_newRespLegal, $enfant);
                }

                //Enregistrement de l'éventuel correspondant administratif
                if($donnees_newCorrespAdmin != null){
                    $this->enregistrerNouveauCorresp($donnees_newCorrespAdmin, $enfant);
                }

                $manager->persist($enfant);
                $manager->flush();

                $this->addFlash('success', $donnes_enfant->getPrenom()." ".$donnes_enfant->getNom()." a été inscrit(e) avec succès !");

                return $this->redirectToRoute('enfant_index');
            }else{
                $errors = $validator->validate($form->getData());

                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }

            }
            
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
            'responsablesLegaux' => $respLegaux,
            'correspondantAdministratif' => $corrAdmin,
        ]);
    }

    /**
     * @Route("/modification/{id}", name="enfant_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Enfant $enfant, ValidatorInterface $validator): Response
    {
        $manager=$this->getDoctrine()->getManager();

        $form = $this->createForm(EnfantType::class, $enfant);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()){
                $donnes_enfant = $form->getData();
            //Récupération des données formulaires de saisie d'un éventuel nouvel établissement/correspondant administratif/responsable légal
                $donnees_newEtablissement = $donnes_enfant->getNewEtablissement();
                $donnees_newRespLegal = $donnes_enfant->getNewResponsableLegal();
                $donnees_newCorrespAdmin = $donnes_enfant->getNewCorrespondantAdministratif();

                if($donnees_newEtablissement != null){
                    $this->enregistrerNouvelEtablissement($donnees_newEtablissement, $enfant);
                }

            //Enregistrement de l'éventuel nouveau établissement
                if($donnees_newRespLegal != null){
                    $this->enregisterNouveauResp($donnees_newRespLegal, $enfant);
                }

            //Enregistrement de l'éventuel correspondant administratif
                if($donnees_newCorrespAdmin != null){
                    $this->enregistrerNouveauCorresp($donnees_newCorrespAdmin, $enfant);
                }

                $manager->flush();

                $this->addFlash('success', "La fiche de ".$donnes_enfant->getPrenom()." ".$donnes_enfant->getNom()." a été modifiée avec succès !");

                return $this->redirectToRoute('enfant_index');


            }else{
                $errors = $validator->validate($form->getData());

                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
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

        $this->addFlash('success', $donnes_enfant->getPrenom()." ".$donnes_enfant->getNom().' a été désinscrit.');

        return $this->redirectToRoute('enfant_index');
    }




    private function enregistrerNouvelEtablissement(Etablissement $donnees_newEtablissement, Enfant $enfant){
        $new_etablissement = new Etablissement();
        $new_etablissement->setNom($donnees_newEtablissement->getNom());
        $new_etablissement->setVille($donnees_newEtablissement->getVille());

        $this->getDoctrine()->getManager()->persist($new_etablissement);
        $enfant->setEtablissement($new_etablissement);
    }

    private function enregisterNouveauResp(ResponsableLegal $donnees_newRespLegal, Enfant $enfant){
        $new_respLegal = new ResponsableLegal();

        $new_respLegal->setNom($donnees_newRespLegal->getNom());
        $new_respLegal->setPrenom($donnees_newRespLegal->getPrenom());
        $new_respLegal->setEmail($donnees_newRespLegal->getEmail());
        $new_respLegal->setTelDom($donnees_newRespLegal->getTelDom());
        $new_respLegal->setTelPort($donnees_newRespLegal->getTelPort());
        $new_respLegal->setTelTrav($donnees_newRespLegal->getTelTrav());

        $this->getDoctrine()->getManager()->persist($new_respLegal);
        $enfant->setResponsableLegal($new_respLegal);
    }

    private function enregistrerNouveauCorresp(CorrespondantAdministratif $donnees_newCorrespAdmin, Enfant $enfant){
        $new_correspAdmin = new CorrespondantAdministratif();

        $manager=$this->getDoctrine()->getManager();

        $responsable = $donnees_newCorrespAdmin->getNewResponsableLegal();

        if($responsable != null){//Si le formulaire a été rempli
            enregisterNouveauResp($responsable);
            $new_correspAdmin->setResponsableLegal($responsable);
        }else{
            $new_correspAdmin->setResponsableLegal($donnees_newCorrespAdmin->getResponsableLegal());
        }
        
        $new_correspAdmin->setNumSecu($donnees_newCorrespAdmin->getNumSecu());
        $new_correspAdmin->setAideCaf($donnees_newCorrespAdmin->getAideCaf());
        $new_correspAdmin->setAideMsa($donnees_newCorrespAdmin->getAideMsa());
        $new_correspAdmin->setAideAutres($donnees_newCorrespAdmin->getAideAutres());

        $manager->persist($new_correspAdmin);

        $enfant->setCorrespondantAdministratif($new_correspAdmin);
    }
}
