<?php

namespace App\Controller;

use App\Form\ConditionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{
    #[Route('/admin/footer', name: 'admin_footer')]
    public function index(): Response
    {
        return $this->render('admin/footer/index.html.twig', [
            'controller_name' => 'FooterController',
        ]);
    }

    #[Route('/admin/mentionLegale', name: 'admin_mentionLegale')]
    public function mentionLegale(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(ConditionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Les Mentions ont bien été modifiées.");
            return $this->redirectToRoute("admin_mentionLegale");
        }

        return $this->render('admin/footer/mentionLegale.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

