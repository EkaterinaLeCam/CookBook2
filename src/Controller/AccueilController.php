<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil', methods:['GET'])]
    public function index(RecetteRepository $recette,): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',

            //Récuperation des 6 dernières recettes
            'recette'=>$recette->findBy(
                [],
                ['id'=>'DESC'],
                9)
        ]);
    }
}
