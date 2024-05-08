<?php

namespace App\Controller;

use App\Form\PostType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/post/create', name: 'post_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class);

        //Solo si se envia el formulario
        $form->handleRequest($request);
        if( $form->isSubmitted()){
            //Guardamos en la bdd
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Prueba form #1 con éxito');
            return $this->redirectToRoute('post_create');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
