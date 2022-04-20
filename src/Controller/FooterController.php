<?php

namespace App\Controller;

use App\Entity\Condition;
use App\Form\ConditionType;
use App\Repository\ConditionRepository;
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

    #[Route('/admin/{nom}/edit', name: 'admin_condition_edit')]
    public function edit($nom, ConditionRepository $conditionRepository, Request $request, EntityManagerInterface $em): Response
    {
        //je vais chercher la condition qui correspond au nom reçu dans la route
        $condition = $conditionRepository->findOneBy([
            'title' => $nom
        ]);
        // je crée une variable qui va me permettre de savoir si je suis en train d'éditer ou pas
        $isEdit=true;
        // si condition est égale à null on la crée
        if(!$condition)
        {   
            $condition = new Condition();
            $condition->setTitle($nom);
            $isEdit=false;
        }

        $form = $this->createForm(ConditionType::class, $condition);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            if(!$isEdit){
                $em->persist($condition);
            }
            
            $em->flush();

            $this->addFlash("success", "Les Mentions ont bien été modifiées.");
            return $this->redirectToRoute("admin_condition_edit",[
                "nom" => $nom
            ]);
        }

        return $this->render('admin/footer/condition_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/customer/{nom}/show', name: 'customer_condition_show')]
    public function show($nom, ConditionRepository $conditionRepository, Request $request, EntityManagerInterface $em): Response
    {
        //je vais chercher la condition qui correspond au nom reçu dans la route
        $condition = $conditionRepository->findOneBy([
            'title' => $nom
        ]);
    
        // si condition est égale à null on redirige vers la page d'acceuil
        if(!$condition)
        {   
            return $this->redirectToRoute("home");
        }

        
        return $this->render('customer/footer/document.html.twig', [
            'condition' => $condition,
        ]);
    }
}

