<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/category')]
class AdminCategoryController extends AbstractController
{
    #[Route('/', name: 'admin/category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
         //Je vais chercher des donnees
        $categories = $categoryRepository->findAll();

        //J'envoie les donnees dans la vue et je gere l'affichage
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    

    #[Route('/new', name: 'admin/category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        //Je crée une instance de la classe Category
        $category = new Category();

         //Je crée un formulaire ,  a partir de la classe CategoryType 
        //J'injece l'objet $category dans le formulaire
        $form = $this->createForm(CategoryType::class, $category);

        //Elle permet d'aller chercher les donnees dans la request 
        //Et de gerer differentes actions qui se passent derriere le rideau
        $form->handleRequest($request);

    
         //Je vérifie si le formulaire a bien été rempli 
        //et surtout, rempli convenablement
        if ($form->isSubmitted() && $form->isValid()) {

            //je  persiste l'entité à envoyer en bdd
            //je vérifie si toutes les données obligatoire pour enregistrer
            //là une catégorie en bdd ont bien été remplie
            $entityManager->persist($category);

            //La fonction flush permet de vraiment envoyer les infos en bdd
            $entityManager->flush();

        
            //Je fais une redirection vers la page de listing des catégories
            return $this->redirectToRoute('admin/category_index', [], Response::HTTP_SEE_OTHER);
        }

        //Si je suis dans un cas où le formulaire n'a pas encore été soumis
        //Je gère l'affichage du formulaire
        //Pour cela j'envoie entre autre dans la vue , une variable qui représente le formulaire
        //que j'ai construis
        return $this->renderForm('admin/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin/category_show', methods: ['GET'])]
    public function show(int $id, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->find($id);

        if(!$category)
        {
            $this->addFlash("Danger","La catégorie est introuvable");
            return $this->redirectToRoute("admin_category_index");

        }
        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin/category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin/category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin/category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/category_index', [], Response::HTTP_SEE_OTHER);
    }
}
