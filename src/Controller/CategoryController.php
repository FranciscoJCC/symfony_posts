<?php

namespace App\Controller;
use App\Entity\Category;
use App\Form\CategoryType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/create', name: 'category_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {   

        $form = $this->createForm(CategoryType::class);

        //Solo si se envia el formulario
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Categoria creada con éxito');
            return $this->redirectToRoute('category_create');
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id}/update', name: 'category_update', methods: ['GET', 'POST'])]
    public function update(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {   

        $form = $this->createForm(CategoryType::class, $category);

        //Solo si se envia el formulario
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            
            $entityManager->flush();

            $this->addFlash('success', 'Categoria editada con éxito');
            return $this->redirectToRoute('category_update', [
                'id' => $category->getId()
            ]);
        }

        return $this->render('category/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
