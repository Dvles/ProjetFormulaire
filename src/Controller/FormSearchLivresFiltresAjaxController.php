<?php

namespace App\Controller;

use App\Form\SearchFiltreLivresType;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormSearchLivresFiltresAjaxController extends AbstractController
{
    #[Route('/livres/search', name: 'livresSearch')]
    public function index(Request $req, LivreRepository $rep): Response
    {
        $form = $this->createForm(SearchFiltreLivresType::class);
        $form->handleRequest($req);

        // gestion du submit du form
        if ($form->isSubmitted() && $form->isValid()){
            
            //$livres = $rep->findAll(); // array d'objets
            $livres = $rep->livresEntreDeuxPrix($form->getData()); // array d'objets

            $vars = ['livres' => $livres];
            return $this->render('form_search_livres_filtres_ajax/livres_search_afficher.html.twig', $vars);
            // $rep->findAll(); // array d'objets
            // dd($form->getData());
        }

        $vars = ['form' => $form];
        //return $this->render('form_search_livres_filtres_ajax/livres_search_afficher.html.twig');
        return $this->render('form_search_livres_filtres_ajax/livres_search.html.twig', $vars);
    }
}
