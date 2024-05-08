<?php

namespace App\Controller;
use  App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PageController extends AbstractController
{
    #[Route('/contact-v1', methods:['GET', 'POST' ])]
    public function contactV1(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', TextType::class, [
                'label' => 'Correo electrónico',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Comentario, sugerencia o mensaje',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enviar',
            ])
            //->setMethod('POST') //Default POST, puede ser GET o PUT
            //->setAction('otra-url')
            ->getForm();

        $form->handleRequest($request);
        if( $form->isSubmitted()){
            //getData() tiene todos los valores que se han enviado
            dd($form->getData(), $request);
        }

        return $this->render('page/contact-v1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact-v2', methods:['GET', 'POST' ])]
    public function contactV2(Request $request): Response
    {
        //Creación del formulario
        $form = $this->createForm(ContactType::class);

        //Manejo del formulario, cuando es enviado
        $form->handleRequest($request);
        if( $form->isSubmitted()){
            dd($form->getData(), $request);
        }

        //Retornamos la vista
        return $this->render('page/contact-v2.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
