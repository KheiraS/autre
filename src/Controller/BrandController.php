<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    public function __construct(BrandRepository $brandRepository,ProductRepository $productRepository){
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;

    }
    #[Route('/brand', name: 'brand')]
    public function index(): Response
    {
        $brand =$this->brandRepository->findAll();
        return $this->render('brand/index.html.twig', [
            'brands' => $brand,
        ]);
    }

    #[Route('detail/{idBrand}', name: 'brand_detail')]
    public function brandDetail(ProductRepository $productRepository, $idBrand): Response
    {
        $products = $productRepository->findbyidBrand($idBrand);

        return $this->render('brand/detail.html.twig', [
            'products'=> $products,

        ]);
    }

}
