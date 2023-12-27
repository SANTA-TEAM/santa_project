<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ReindeersRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ReindeersRepository $reindeersRepository,
        UserRepository $userRepository,
        CommentRepository $commentRepository
    ): Response {


        // remove user after 1 year (RGPD) -> to include on main controllers
        $users = $userRepository->findAll();

        $time = '- 1 year';

        foreach ($users as $user) {
            if ($user->getRoles() === ['ROLE_USER']) {
                if ($user->getCreatedAt() > new \DateTime($time)) {
                    $userRepository->removeUser($user);
                }
            }
        }
        
        $reindeers = $reindeersRepository->findAll();
        $comments = $commentRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'reindeers' => $reindeers,
            'comments' => $comments
        ]);
    }
}
