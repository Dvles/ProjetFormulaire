<?php

namespace App\Controller;

use App\Entity\Aeroport;
use App\Form\AeroportType;
use App\Repository\AeroportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormulairesController extends AbstractController
{

    


    #[Route('/formulaires', name: 'app_formulaires')]
    public function index(): Response
    {
        return $this->render('formulaires/index.html.twig');
    }

    #[Route('/formulaires/aeroport/ajouter', name: 'app_aeroport_ajouter')]
    public function aeroportAfficher(Request $req, ManagerRegistry $doctrine): Response
    {
        $aeroport = new Aeroport(); // mettre dans entité, par defaut array vide otherwise //$aeroport = new Aeroport([]);
        
        //on crée le forme + associe l'entité au form
        $form = $this->createForm(AeroportType::class, $aeroport);

        // gérer l'objet Request. Cet objet contiendra un GET ou un POST
        $form->handleRequest($req);

        // si c'est POST, on va visualiser le contenu de l'entité
        if ($form->isSubmitted() && $form->isValid()){ // isValid regarde toutes les contraintes

            $em = $doctrine->getManager();
            $em->persist($aeroport);
            $em->flush();
            dd($aeroport); //TO DEBUG
            // OR SHOW TO ANOTHER VIEW
        }
        //dd($form);
        $vars = ['formulaireAeroport'=>$form];

        return $this->render('formulaires/ajouter_aeroport.html.twig', $vars
        );
    }


    // action qui affiche les aeroports
    #[Route('/formulaires/afficher/aeroports', name: 'app_formulaires')]
    public function afficherAeroports(ManagerRegistry $doctrine): Response
    {
        // obtenir tout de la DB
        $em = $doctrine->getManager();
        $aeroports = $em->getRepository(Aeroport::class)->findAll();
        // dd($aeroports);
        $vars = ['aeroports' => $aeroports];
        // dd($vars);

        
        return $this->render('formulaires/afficher_aeroports.html.twig', $vars);
    }




    // update de l'aeroport
    #[Route ('/formulaires/update/aeroport/{id}', name: 'UpdateAeroport')]
    public function updateAeroport(Request $req, AeroportRepository $rep, EntityManagerInterface $em){

        $id = $req->get('id');
        $aeroport = $rep->find($id);
        // dd($aeroport);


        $form = $this->createForm(AeroportType::class, $aeroport); // FILL FORM WITH ENTITY DATA
        
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $em->flush();
            dd($aeroport);
        }
        
        $vars = ['formulaireAeroport'=>$form];

        return $this->render('formulaires/update_aeroports.html.twig', $vars);




    }


}

