<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
     */
    public function index()
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/authentification", name="authentification")
     */
    public function affichageFormulaireAuthentification(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
    
    /**
     * @Route("/gestionAffaires", name="gestionAffaires_index")
     */
    public function affichageIndex_gestionListesAffaires(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/creationTypeListe", name="gestionListesAffaires_creationTypeListe")
     */
    public function demandeCreation_TypeListe(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/consultationTypeListe/{id}", name="gestionListesAffaires_consultationTypeListe")
     */
    public function demandeConsultation_TypeListe(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/modificationTypeListe/{id}", name="gestionListesAffaires_modificationTypeListe")
     */
    public function demandeModification_TypeListe(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/creationListe", name="gestionListesAffaires_creationListe")
     */
    public function demandeCreation_Liste(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/consultationListe/{id}", name="gestionListesAffaires_consultationListe")
     */
    public function demandeConsultation_Liste(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionListesAffaires/modificationListe/{id}", name="gestionListesAffaires_modificationListe")
     */
    public function demandeModification_Liste(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionEnfants", name="gestionEnfants_index")
     */
    public function affichageIndex_gestionEnfants(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionEnfants/creation", name="gestionEnfants_creation")
     */
    public function demandeCreation_enfant(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionEnfants/consultation/{id}", name="gestionEnfants_consultation")
     */
    public function demandeConsultation_enfant(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionEnfants/modification/{id}", name="gestionEnfants_modification")
     */
    public function demandeModification_enfant(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionSejours", name="gestionSejour_index")
     */
    public function affiichageIndex_gestionSejours(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionSejours/creation", name="gestionSejour_creation")
     */
    public function demandeCreation_sejour(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionSejours/consultation/{id}", name="gestionSejour_consultation")
     */
    public function demandeConsultation_sejour(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/gestionSejours/modification/{id}", name="gestionSejour_modification")
     */
    public function demandeModification_sejour(){
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
