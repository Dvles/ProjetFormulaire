<?php

namespace App\Controller;

use App\Entity\Aeroport;
use App\Form\AeroportType;
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

    #[Route('/formulaires/aeroport/afficher', name: 'app_aeroport_afficher')]
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


        return $this->render('formulaires/aeroport_afficher.html.twig',$vars
        );
    }
}

