<?php

namespace App\Controller;

use App\Services\rgpd;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(
        Request $request,
        rgpd $rgpd,
        EntityManagerInterface $entityManager
    ): Response {
        // delete after 1 year
        $rgpd->deleteUser();
        
        $comment = new Comment();
        $formComment = $this->createForm(CommentType::class, $comment);
        $formComment->handleRequest($request);
        if ($formComment->isSubmitted() && $formComment->isValid()) {
            $comment = $formComment->getData();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_comment');
        }

        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
            'formComment' => $formComment->createView(),
        ]);
    }
}
