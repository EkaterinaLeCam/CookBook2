<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories', methods:'GET')]
    public function index(Request $request, CategorieRepository $categorieRepository): Response
    {
        //Récuperer tout les objets Categorie à partir du CategorieRepository
        $categories=$categorieRepository->findAll();
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
            'categories'=>$categories,
        ]);
    }
}
