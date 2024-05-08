<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PageController extends AbstractController
{
    #[Route('/contact-v1', methods:['GET', 'POST' ])]
    public function contactV1(): Response
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
            ->setMethod('POST') //Default POST, puede ser GET o PUT
            ->setAction('otra-url')
            ->getForm();

        return $this->render('page/contact-v1.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
