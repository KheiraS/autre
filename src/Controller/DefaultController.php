<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $productRepository;
    private $categoryRepository;



    public function __construct (ProductRepository $productRepository, CategoryRepository $categoryRepository){
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Method to display all the products on default/index page
     * @return Response
     */
    #[Route('/', name: 'default')]
    public function index(): Response
    {
        $products = $this->productRepository->findByOffer();
        return $this->render('default/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Method to display product by id on default/index page
     *
     */
    #[Route('product/{id}', name: 'product_detail')]
    public function getOne(Product $product)
    { return $this->render('default/product.html.twig',[
        'product' => $product
    ]);

    }


    /**
     * Method to display ACCOUNT PAGE
     *
     */
    #[Route('/account', name: 'account')]
    public function account()
    {
        return $this->render('default/account.html.twig');
    }

    /**
     * Method to display SERVICE PAGE
     *
     */
    #[Route('/services', name: 'services')]
    public function services()
    {
        return $this->render('default/services.html.twig');
    }

    /**
     * Method to display CONTACT PAGE
     *
     */
    #[Route('/contact', name: 'contact')]
    public function contactForm()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * Method to display TERMS PAGE
     *
     */
    #[Route('/terms', name: 'terms')]
    public function termsOfUse()
    {
        return $this->render('default/terms.html.twig');
    }

    /**
     * Method to display CONDITIONS PAGE
     *
     */
    #[Route('/conditions', name: 'conditions')]
    public function conditions()
    {
        return $this->render('default/conditions.html.twig');
    }


    /**
     * Method to display DYNAMIC MENU
     * with categories
     */
    public function navbar()
    {
        $categories = $this->categoryRepository->findParentCategory();

        return $this->render('parts/header.html.twig', [

            'categories' => $categories,
        ]);
    }
}
