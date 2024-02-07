<?php

namespace App\Controller;

use App\Entity\Gift;
use App\Entity\User;
use App\Entity\Letter;
use App\Form\LetterType;
use App\Repository\GiftRepository;
use App\Repository\UserRepository;
use App\Repository\LetterRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LetterController extends AbstractController
{
    #[Route('/letter', name: 'app_letter', methods: ['POST', 'GET'])]
    public function index(
        Request $request,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        GiftRepository $giftRepository,
        LetterRepository $letterRepository,
        SessionInterface $session
    ): Response {

        $letter = $session->get('letter');

        if (!$letter) {
            $letter = [];
        }

        $category = $categoryRepository->findAll();
        $gift = $giftRepository->findAll();

        // if fetch for update gifts in letter (delete)
        if ($request->isMethod('POST') && $request->headers->get('Content-Type') === 'application/json') {
            
            $json = $request->getContent();
            $requestData = json_decode($json, true);

            $letter = $requestData;
            $session->set('letter', $letter);

            $response = new JsonResponse($requestData);
            return $response;
        }

        // create new Letter and array for gifts display
        $newLetter = new Letter;
        $gifts = [];

        if ($letter != []) {
            foreach ($letter as $giftId) {
                $gift = $giftRepository->findOneBy(['id' => $giftId]);
                $newLetter->addGift($gift);
                $gifts[] = $gift;
            }
        }       


        $formLetter = $this->createForm(LetterType::class, $newLetter);
        $formLetter->handleRequest($request);

        if ($formLetter->isSubmitted() && $formLetter->isValid()) {
            // useless ? 
            foreach ($letter as $giftId) {
                $gift = $giftRepository->findOneBy(['id' => $giftId]);
                $newLetter->addGift($gift);
            }

            // letter's author : check if exist before create
            $email = $formLetter->get('writer')->get('email')->getData();
            $user = $userRepository->findOneBy(['email' => $email]);
            if (!$user) {
                $user = new User;
                $user = $formLetter->get('writer')->getData();

                $userRepository->save($user);
            }


            // set author with user
            $newLetter->setWriter($user);

            $letterRepository->save($newLetter);
            $newLetter = null;
            $session->clear();

            $this->addFlash('success', 'Tu as bien envoyé ta lettre !');
            return $this->redirectToRoute('app_letter');
        }

        return $this->render('letter/index.html.twig', [
            'form' => $formLetter->createView(),
            'gifts' => $gifts
        ]);
    }

    // #[Route('/lettre/cadeaux/supprimer/{id}', name: 'app_letter_update', methods: ['GET'])]
    // public function removeGift(
    //     SessionInterface $session,
    //     GiftRepository $giftRepository,
    //     int $id
    // ): Response {

    //     $letter = $session->get('letter');

    //     $gift = $giftRepository->findOneBy(['id' => $id]);
    //     // dd($letter);

    //     foreach ($letter as $giftId) {
    //         $gift = $giftRepository->findOneBy(['id' => $giftId]);
    //         $letter->addGift($gift);
    //     }


    //     if ($letter) {
    //         $letter->removeGift($gift);
    //     }
    //     $letterGifts = [];

    //     foreach ($letter->getGift() as $gift) {
    //         $letterGifts[] = [
    //             'id' => $gift->getId(),
    //             'name' => $gift->getName(),
    //             'category' => $gift->getCategory(),
    //             'age' => $gift->getAge(),
    //             'images' => $gift->getImages()
    //         ];
    //     }

    //     $letterGifts = new JsonResponse($letterGifts);

    //     return $letterGifts;
    // }
}
