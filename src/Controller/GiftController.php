<?php

namespace App\Controller;

use App\Entity\Letter;
use App\Entity\Age;
use App\Entity\Category;
use App\Form\GiftFilterType;
use App\Repository\AgeRepository;
use App\Repository\GiftRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GiftController extends AbstractController
{
    #[Route('/salle-aux-cadeaux', name: 'app_gift')]
    public function index(
        GiftRepository $giftRepository,
        CategoryRepository $categoryRepository,
        AgeRepository $ageRepository,
        Request $request,
    ): Response {
        $gifts = $giftRepository->findGiftsWithImages();

        $categories = $categoryRepository->findAll();
        $ages = $ageRepository->findAll();


        $form = $this->createForm(GiftFilterType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $category = $form->get('category')->getData();
            $age = $form->get('age')->getData();
            $order = $form->get('order')->getData();

            $gifts = $giftRepository->filter($age, $category, $order);
        }

        return $this->render('gift/index.html.twig', [
            'gifts' => $gifts,
            'ages' => $ages,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    #[Route('/cadeaux/filtre', name: 'app_gift_filter', methods: ['GET', 'POST'])]
    public function filter(
        GiftRepository $giftRepository,
        CategoryRepository $categoryRepository,
        AgeRepository $ageRepository,
        Request $request
    ) {
        $json = $request->getContent();

        $requestData = json_decode($json, true);

        $order = $requestData['order'] === 'null' ? null : $requestData['order'];
        $age = $requestData['age'] === 'null' ? null : $requestData['age'];
        $category = $requestData['category'] === 'null' ? null : $requestData['category'];


        $age = $age === null ? null : $ageRepository->findOneBy(['id' => $age]);
        $category = $category === null ? null : $categoryRepository->findOneBy(['id' => $category]);

        $gifts = $giftRepository->filter($age, $category, $order);

        $giftsArray = [];
        foreach ($gifts as $gift) {
            $giftsArray[] = [
                'id' => $gift->getId(),
                'name' => $gift->getName(),
                'description' => $gift->getDescription(),
                'age' => $gift->getAge()->getAge(),
                'category' => $gift->getCategory()->getName(),
                'images' => $gift->getImages()
            ];
        }

        $response = new JsonResponse($giftsArray);

        return $response;
    }

    #[Route('/cadeau/{slug}', name: 'app_gift_detail', methods: ['GET'])]
    public function detail(
        GiftRepository $giftRepository,
        string $slug
    ): Response {
        $gift = $giftRepository->findOneBy(['slug' => $slug]);

        return $this->render('gift/detail.html.twig', [
            'gift' => $gift
        ]);
    }

    #[Route('/cadeau/ajouter-a-ma-lettre/{slug}', name: 'app_gift_add_to_letter', methods: ['GET'])]
    public function addToLetter(
        GiftRepository $giftRepository,
        string $slug,
        SessionInterface $session
    ): Response {

        $gift = $giftRepository->findOneBy(['slug' => $slug]);

        $letter = $session->get('letter');
        if (!$letter) {
            $letter = new Letter();
        }
        $letter->addGift($gift);

        $session->set('letter', $letter);

        $this->addFlash('success', 'Le cadeau a bien été ajouté à votre lettre');
        return $this->redirectToRoute('app_gift');
    }
}
