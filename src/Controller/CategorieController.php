<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/categorie/{id}', name: 'app_categorie', methods:'GET')]
    public function index($id): Response
    {
        //Afficher tout les Categories demandées dans la template dédié
        $categorie = $this-> entityManager-> getRepository(Categorie::class)->find($id);
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categorie'=>$categorie,
        ]);
    }
}
