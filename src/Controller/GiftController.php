<?php

namespace App\Controller;

use App\Entity\Age;
use App\Entity\Category;
use App\Repository\AgeRepository;
use App\Repository\GiftRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiftController extends AbstractController
{
    #[Route('/salle-aux-cadeaux', name: 'app_gift')]
    public function index(
        GiftRepository $giftRepository,
        CategoryRepository $categoryRepository, 
        AgeRepository $ageRepository
    ): Response
    {
        $gifts = $giftRepository->findGiftsWithImages();

        $categories = $categoryRepository->findAll();
        $ages = $ageRepository->findAll();
        
        return $this->render('gift/index.html.twig', [
            'gifts' => $gifts,
            'ages' => $ages,
            'categories' => $categories,
        ]);
    }
}
