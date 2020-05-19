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

use Symfony\Component\Validator\Validator\ValidatorInterface;



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
        //Implémentation du formulaire de création d'une affaire
        $nouvelleAffaire = new Affaire();
        $formCreate = $this->createForm(AffaireType::class, $nouvelleAffaire);
        $formCreate->handleRequest($request);

        $toutesLesAffaires = $affaireRepository->findAll();
        /*L'idée pour mettre les formulaires de modification est de passer un tableau de vues
        de formulaires à la vue "index".
        Ce tableau est composé de la vue d'un formulaire de chaque affaire de la BD.
        */
        /*
        $tableauFormulairesEdit = [];

        foreach($toutesLesAffaires as $affaire){
            $formEdit = $this->createForm(AffaireType::class, $affaire);
            $formEdit->handleRequest($request);
            $vueFormEdit = $formEdit->createView();
            array_push($tableauFormulairesEdit, $vueFormEdit);
        }*/

        return $this->render('affaire/index.html.twig', [
            'affaires' => $toutesLesAffaires,
            'formCreate' => $formCreate->createView(),
            //'tableauFormulairesEdit' => $tableauFormulairesEdit //On passe le tableau de formulaires dans la vue
        ]);
    }

    /**
     * @Route("/", name="affaire_creation", methods={"GET","POST"})
     */
    public function newAffaire(Request $request, ValidatorInterface $validator): Response
    {
        $affaire = new Affaire();
        $form = $this->createForm(AffaireType::class, $affaire);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($affaire);
                $entityManager->flush();

                $this->addFlash('success', 'L\'affaire '.$form->getData()->getNomFrancais().' a été créée avec succès !');
            }
            else{
                $errors = $validator->validate($form->getData());

                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
            
        }
        
        return $this->redirectToRoute('affaire_index');
        
    }

    /**
     * @Route("/modification/{id}", name="affaire_modification", methods={"GET","POST"})
     */
    public function editAffaire(Request $request, Affaire $affaire, ValidatorInterface $validator): Response
    {
        $form = $this->createForm(AffaireType::class, $affaire);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $donnees_affaire = $form->getData();
            if($form->isValid()){
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'L\'affaire '.$donnees_affaire->getNomFrancais().' a été modifiée avec succès !');

                return $this->redirectToRoute('affaire_index');
            }
            else{
                $errors = $validator->validate($form->getData());

                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }          
        }

        //return $this->redirectToRoute('affaire_index'); //À utiliser lors de la modification sur la page "index"
        
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

            $this->addFlash('success', 'L\'affaire '.$affaire->getNomFrancais().' a été supprimée !');
        }

        return $this->redirectToRoute('affaire_index');
    }

    /*Le contrôleur de type_affair n'a pas été modfiié. Dans l'optique d'avoir un modal de
    création/modification de type d'affaire, les render et les redirect seront surement
    à modifier.
    */

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
