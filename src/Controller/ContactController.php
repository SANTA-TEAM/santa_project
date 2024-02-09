<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\rgpd;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\UserRepository;
use App\Repository\AddressRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        UserRepository $userRepository,
        MessageRepository $messageRepository,
        AddressRepository $addressRepository,
        rgpd $rgpd
    ): Response {
        // delete after 1 year
        $rgpd->deleteUser();
        
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $userRepository->findOneBy(['email' => $form->get('writer')->get('email')->getData()]);

            if (!$user) {
                $user = new User();
                $user = $message->getWriter();
                $addressRepository->save($user->getAddress()); // persist address on cascade ?
                $userRepository->save($user);
            }
            $message = $form->getData();
            $message->setWriter($user);

            $messageRepository->save($message);

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
