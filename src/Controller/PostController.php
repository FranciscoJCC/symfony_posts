<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class);

        //Solo si se envia el formulario
        $form->handleRequest($request);
        if( $form->isSubmitted()){
            //Guardamos en la bdd
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Publicación creada con éxito');
            return $this->redirectToRoute('post_create');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/post/{id}/update', name: 'post_update', methods: ['GET', 'POST'])]
    public function update(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);

        //Solo si se envia el formulario
        $form->handleRequest($request);
        if( $form->isSubmitted()){
            //Guardamos en la bdd
            //$entityManager->persist($form->getData()); //Linea opcional en el update
            $entityManager->flush();

            $this->addFlash('success', 'Publicación editada con éxito');
            return $this->redirectToRoute('post_update', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('post/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
