<?php 

namespace App\Controller\Purchase;

use Stripe\Stripe;
use App\Entity\User;
use Stripe\Checkout\Session;
use App\Services\Cart\HandleCart;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    #[Route('/boutique/commande/stripe/session', name: 'boutique_stripe_session')]
    public function createSession(HandleCart $handleCart)
    {
        
        Stripe::setApiKey('sk_test_51KQApCAwqWguGXeqn4RgkcPjusmRFrm52LnIWwyWyhHT7bryB4HYlRFKZXga44wZU8hNJZg9uzFbYhWCGF6gJdC400xJJCKyiV');
        
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
        //$YOUR_DOMAIN = 'https://projet01.ronaldmedaus.com';

        /** @var User $user */
        $user = $this->getUser();

        $productsDetail = $handleCart->detailPanier();

        $productForStripe = [];

        foreach($productsDetail as $item)
        {
            $productForStripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->getProduct()->getPrice(),
                    'product_data' => [
                        'name' => $item->getProduct()->getName(),
                        'images' => [
                        $item->getProduct()->getImagePath()
                        ]
                    ]
                ],
                'quantity' => $item->getQty()
            ];
        }
        
        $checkout_session = Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [[
            $productForStripe
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/boutique/paiement/success',
            'cancel_url' => $YOUR_DOMAIN . '/boutique/paiement/cancel',
        ]);

        return $this->redirect($checkout_session->url);
    }
}