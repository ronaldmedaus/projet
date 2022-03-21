<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFooterController extends AbstractController
{
    #[Route('/admin/footer', name: 'admin_footer')]
    public function index(): Response
    {
        return $this->render('admin/footer/index.html.twig', [
            'controller_name' => 'FooterController',
        ]);
    }

}
