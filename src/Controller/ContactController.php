<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\AddressRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
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
        ): Response
    {

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $message = $form->getData();
            $user = $userRepository->findOneBy(['email' => $form->get('writer')->get('email')->getData()]);

            if (!$user) {
                $user = new User();
                $user = $message->getWriter();
                $addressRepository->save($user->getAddress()); // persist address on cascade ?
                $userRepository->save($user);
            }
            
            $messageRepository->save($message);

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
