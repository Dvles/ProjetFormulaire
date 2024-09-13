<?php

namespace App\Controller;

use App\Form\SearchFiltreLivresType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormSearchLivresFiltresAjaxController extends AbstractController
{
    #[Route('/livres/search', name: 'livresSearch')]
    public function index(Request $req): Response
    {
        
        
        $form = $this->createForm(SearchFiltreLivresType::class);
        $vars = ['form' => $form];

        return $this->render('form_search_livres_filtres_ajax/livres_search.html.twig', $vars);
    }
}
