<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ReindeersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ReindeersRepository $reindeersRepository,
        CommentRepository $commentRepository): Response
    {

        $reindeers = $reindeersRepository->findAll();
        $comments = $commentRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'reindeers' => $reindeers,
        ]);
    }
}
