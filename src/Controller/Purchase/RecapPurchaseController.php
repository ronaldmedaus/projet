<?php

namespace App\Controller\Purchase;

use App\Entity\ContentListProduct;
use App\Entity\Purchase;
use App\Form\PurchaseType;
use App\Services\Cart\HandleCart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RecapPurchaseController extends AbstractController
{
    #[Route('/boutique/commande/recap', name: 'boutique_commande_recap')]
    public function recap(HandleCart $handleCart, Request $request, EntityManagerInterface $em)
    {
        $detailPanier = $handleCart->detailPanier();

        $purchase = new Purchase();

        $form = $this->createForm(PurchaseType::class, $purchase);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $purchase->setUser($this->getUser());

            $em->persist($purchase);

            //$contentListProduct = new ContentListProduct();

            //$contentListProduct->setPurchase($purchase);

            //$em->persist($contentListProduct);

            foreach ($detailPanier as $item) {
                $contentList = new ContentListProduct();

                $contentList->setProduct($item->getProduct());
                $contentList->setQuantity($item->getQty());
                $contentList->setPurchase($purchase);

                $em->persist($contentList);
            }

            $em->flush();
            //TODO
            return $this->redirectToRoute("boutique_stripe_session");
        }

        $total = $handleCart->getTotalPanier();

        return $this->render("customer/purchase/recap.html.twig", [
            'form' => $form->createView(),
            'detailProducts' => $detailPanier,
            'totalPrixPanier' => $total
        ]);
    }
}
