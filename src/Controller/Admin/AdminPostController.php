<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Dictionary\PostStatus;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPostController extends AbstractController
{
    #[Route('/admin/post/list', name: 'admin_post_list')]
    public function list(PostRepository $postRepository)
    {   //on va chercher dans la base de donnée
        $posts = $postRepository->findAll();
        //on envoie dans la vue
        return $this->render("admin/post/list.html.twig",[
            //on envoie tous les posts
            'posts' => $posts
        ]);
    }

    #[Route('/admin/post/new', name: 'admin_post_new')]
    public function create(EntityManagerInterface $em, Request $request)
    {
        $post = new Post();

        $toto = $this->createForm(PostType::class,$post);

        $toto->handleRequest($request);

        if($toto->isSubmitted() && $toto->isValid())
        {
            $em->persist($post);
            $em->flush();
                //on envoie dans la vue
            $this->addFlash("success","Le post a bien été créé.");
            return $this->redirectToRoute("admin_post_list");
        }

        return $this->render("admin/post/new.html.twig",[
            'toto' => $toto->createView()
        ]);
    }

    #[Route('/admin/post/show/{id}', name: 'admin_post_show')]
    public function show(int $id, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        if(!$post)
        {
            $this->addFlash("danger","Le post est introuvable.");
            return $this->redirectToRoute("admin_post_list");
        }

        return $this->render("admin/post/show.html.twig",[
            'post' => $post
        ]);
    }

    #[Route('/admin/post/togglestatus/{id}', name: 'admin_post_toggle_status')]
    public function toggleRole(int $id,PostRepository $postRepository,EntityManagerInterface $em)
    {
        //Je vais chercher en bdd le post correspondant à l'id envoyé
        $post = $postRepository->find($id);

        //Si il existe pas, je renvoi un message d'erreur
        if(!$post)
        {
            $this->addFlash("danger","Post introuvable.");
            return $this->redirectToRoute("admin_post_list");
        }

        //Je vais chercher le role actuel du user
        $status = $post->getStatus();

        //Si son statut actuel est brouillon , je lui attribue le statut publié
        if($status === PostStatus::STATUS_BROUILLON)
        {
            $post->setStatus(PostStatus::STATUS_PUBLISHED);
        }
       //Si son statut actuel est publié , je lui attribue le statut brouillon
        else
        {
            $post->setStatus(PostStatus::STATUS_BROUILLON);
        }

        //Grace au Entity Manager , j'envoie cette modification en bdd
        $em->flush();

        //Ensuite je renvoie un message flash
        $this->addFlash("success","Le statut du post a bien été modifié.");

        //Je redirige vers la liste des users
        return $this->redirectToRoute("admin_post_show",['id' => $id]);
    }
}

