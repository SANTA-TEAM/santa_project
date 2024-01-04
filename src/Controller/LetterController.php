<?php

namespace App\Controller;

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

class LetterController extends AbstractController
{
    #[Route('/letter', name: 'app_letter')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        CategoryRepository $categoryRepository,
        GiftRepository $giftRepository,
        SessionInterface $session
        ): Response
    {

        $letter = $session->get('letter');

        if (!$letter) {
            $letter = new Letter();
        }

        $category = $categoryRepository->findAll();
        $gift = $giftRepository->findAll();

        // $formLetter = $this->createForm(LetterType::class, $letter);
        // $formLetter->handleRequest($request);

        // if ($formLetter->isSubmitted() && $formLetter->isValid()) {
        //     $letter = $formLetter->getData();
        //     $user = $letter->getWriter();
        //     $address = $user->getAddress();
        //     foreach ($letter->getGift() as $gift) {
        //         $gift->addLetter($letter);
        //     }

        //     $entityManagerInterface->persist($user);
        //     $entityManagerInterface->persist($address);
        //     $entityManagerInterface->persist($letter);
        //     $entityManagerInterface->flush();

        //     return $this->redirectToRoute('app_letter');
        // }
        dd($letter);
        return $this->render('letter/index.html.twig', [
            // 'formLetter' => $formLetter->createView(),
        ]);
    }
}
