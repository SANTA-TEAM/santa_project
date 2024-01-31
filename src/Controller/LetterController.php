<?php

namespace App\Controller;

use App\Entity\Gift;
use App\Entity\Letter;
use App\Form\LetterType;
use App\Repository\CategoryRepository;
use App\Repository\GiftRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class LetterController extends AbstractController
{
    #[Route('/letter', name: 'app_letter')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        CategoryRepository $categoryRepository,
        GiftRepository $giftRepository,
        SessionInterface $session
    ): Response {

        $letter = $session->get('letter');

        if (!$letter) {
            $letter = new Letter();
        }
        dd($letter);
        $category = $categoryRepository->findAll();
        $gift = $giftRepository->findAll();

        $formLetter = $this->createForm(LetterType::class, $letter);
        $formLetter->handleRequest($request);
        if ($formLetter->isSubmitted() && $formLetter->isValid()) {
            $letter = $formLetter->getData();
            $user = $letter->getWriter();
            // $entityManagerInterface->persist($user);
            // $entityManagerInterface->persist($address);
            // $entityManagerInterface->persist($letter);
            // $entityManagerInterface->flush();

            return $this->redirectToRoute('app_letter');
        }
        return $this->render('letter/index.html.twig', [
            'form' => $formLetter->createView(),
            'letter' => $letter
        ]);
    }

    #[Route('/lettre/cadeaux/supprimer/{id}', name: 'app_letter_update' , methods: ['GET'])]
    public function removeGift(
        SessionInterface $session,
        int $id
    ): Response {

        $letter= $session->get('letter');

        if ($letter) {
            
            foreach ($letter->getGift() as $gift) {
                if ($gift->getId() === $id) {
                    $letter->removeGift($gift);
                }
            }
        }
        
        // $letterGifts = new JsonResponse($letter->getGift());
        
        $letterGifts = [];

        foreach($letter->getGift() as $gift){
            $letterGifts[] = [
                'id' => $gift->getId(),
                'name' => $gift->getName(),
                'category' => $gift->getCategory(),
                'age' => $gift->getAge(),
                'images' => $gift->getImages()
            ];
        }

        $letterGifts = new JsonResponse($letterGifts);

        return $letterGifts;
    }
}
