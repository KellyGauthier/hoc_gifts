<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render(
            'index/accueil.html.twig', 
            ['controller_name' => 'IndexController']
    );
    }
/**
 * @Route("/contact", name="contact")
 */
    public function contact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($contact);
             $entityManager->flush();

             //TODO Rediriger vers une page de confirmation
        }

        return $this->render(
        'index/contact.html.twig',
        ['contactForm'=> $form->createView()]
        );
    }
}

