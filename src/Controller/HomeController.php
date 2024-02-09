<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\ReindeersRepository;
use App\Services\rgpd;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ReindeersRepository $reindeersRepository,
        CommentRepository $commentRepository,
        Request $request,
        rgpd $rgpd
    ): Response {

        // delete after 1 year
        $rgpd->deleteUser();

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
