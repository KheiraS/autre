<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Form\AddressType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    /*
    * Function to add a product into the cart
    * */
    #[Route('/add-product/{id}', name: 'add', requirements: ['id' => '\d+'])]
    public function addToCart(Product $product, Request $request)
    {
        // A new object Cart is created
        // It will allow us to associate a product with the quantity
        $cart = new OrderItem();
        $cart->setProduct($product);
        $cart->setQuantity(1);

        // We got our session from the Request object of Symfony
        $session = $request->getSession();

        // We create an empty array which represents the basket
        $basket = [];

        // If we have a basket in our session, we will get it
        if ($session->has("basket")) {
            $basket = $session->get("basket");
        }
        // We check if we have this product (same id) in our basket
        $exist = false;
        foreach ($basket as $cartElement) {
            if ($cartElement->getProduct()->getId() == $product->getId()) {
                $exist = true;
                $cartElement->setQuantity($cartElement->getQuantity() + 1);
            }
        }
        if (!$exist) {
            $basket[] = $cart;
        }
        $session->set('basket', $basket);
        return $this->redirectToRoute('cart_display');
    }


    /*
    * Function to display all the products into cart
    * */
    #[Route('/', name: 'display')]
    public function index(Request $request): Response
    {
        $basket = $request->getSession()->get('basket');

        if (is_null($basket)) {
            $basket = [];
        }

        $total = 0;
        // Calculate the total
        foreach ($basket as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        // display the cart
        return $this->render('cart/index.html.twig', [
            'basket' => $basket,
            'total' => $total
        ]);
    }

    /*
    * Function to remove a product from the cart
    * */
    #[Route('/remove-product/{id}', name: 'remove_product')]
    public function removeProduct(Product $product, Request $request)
    {
        $session = $request->getSession();

        $basket = $session->get('basket');

        $delete = null;
        foreach ($basket as $key => $cart) {
            if ($product->getId() == $cart->getProduct()->getId()) {
                $delete = $key;
            }
        }

        unset($basket[$delete]);
        $session->set('basket', $basket);

        return $this->redirectToRoute('cart_display');
    }

    /*
    * Function to increment the quantity of a product
    * */
    #[Route('/{operator}/{id}', name: 'add_remove_one')]
    public function incrementQuantity(Product $product, Request $request, $operator)
    {
        $session = $request->getSession();
        $basket = $session->get('basket');

        foreach ($basket as $item) {
            if ($item->getProduct()->getId() == $product->getId()) {
                if ($operator == 'plus') {
                    $item->setQuantity($item->getQuantity() + 1);
                } elseif ($operator == 'minus') {
                    if ($item->getQuantity() > 1) {
                        $item->setQuantity($item->getQuantity() - 1);
                    } else {
                        $delete = null;
                        foreach ($basket as $key => $cart) {
                            if ($product->getId() == $cart->getProduct()->getId()) {
                                $delete = $key;
                            }
                        }

                        unset($basket[$delete]);
                    }
                }
            }
        }

        $session->set('basket', $basket);
        return $this->redirectToRoute('cart_display');
    }

    #[Route('/validation-cart', name: 'validation')]
    public function validation(Request $request, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(AddressType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->flush();


        }

        $basket = $session->get('basket');

        if (is_null($basket)) {
            $basket = [];
        }
        $total = 0;
        // Calculate the total
        foreach ($basket as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        // display the form
        return $this->render('cart/validation.html.twig', [
            'basket' => $basket,
            'total' => $total,
            'user' => $user,
            'AddressType' => $form->createView()
        ]);
    }

}
