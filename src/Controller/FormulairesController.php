<?php

namespace App\Controller;

use App\Form\AeroportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function aeroportAfficher(): Response
    {
        $form = $this->createForm(AeroportType::class);
        //dd($form);
        $vars = ['formulaireAeroport'=>$form];


        return $this->render('formulaires/aeroport_afficher.html.twig',$vars
        );
    }
}

