<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\ReindeersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ReindeersRepository $reindeersRepository,
        UserRepository $userRepository,
        CommentRepository $commentRepository,
        Request $request
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

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $commentRepository->save($comment);

            $this->addFlash('success', 'Commentaire ajouté !');
            return $this->redirectToRoute('app_home');
        }


        $reindeers = $reindeersRepository->findAll();
        $comments = $commentRepository->findAll();
        return $this->render('home/index.html.twig', [
            'reindeers' => $reindeers,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
}
