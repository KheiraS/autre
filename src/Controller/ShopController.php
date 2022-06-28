<?php

namespace App\Controller;



use App\Form\FilterType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ShopController extends AbstractController
{
    private $categoryRepository;

    public function  __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    #[Route('shop/{idParent}/{currentPage}/{nbResult}', name: 'product_store')]
    public function index(Request $request, ProductRepository $productRepository, CategoryRepository $categoryRepository, $idParent, $currentPage, $nbResult): Response
    {

        $categories = $categoryRepository->findAll();

        $form = $this->createForm(FilterType::class, NULL,['idCategParent'=>$idParent]);
        $form->handleRequest($request);

        $idSubCateg = null;
        if($form->isSubmitted() and $form->isValid()){

            $filters= $form->getData();

            $nbProducts = $productRepository-> findByFilter($filters, $idParent,true, $currentPage,$nbResult);
            $products = $productRepository->findByFilter($filters, $idParent,false, $currentPage,$nbResult);
        }else{
            $nbProducts = $productRepository-> findBySubCategoryResult($idParent);
            $products = $productRepository-> findBySubCategory($idParent, $idSubCateg,$currentPage,$nbResult);

        }

        //PAGINATION //////////////////////////////////////

        // Calculate the number of full page
        $nbPage = $nbProducts/$nbResult;

        // Rest of the division
        if ($nbProducts%$nbResult != 0){
            $nbPage = (int) ($nbProducts/$nbResult) +1; //(int) Get the integer part of calculation
        }


        return $this->render('shop/index.html.twig', [
            'form'=> $form->createView(),
            'products' => $products,
            'nbPage' => $nbPage,
            'currentPage' => $currentPage,
            'nbResult' => $nbResult,
            'categories'=> $categories,
            'idParent'=>$idParent,
            'idSubCateg'=>$idSubCateg,

        ]);
    }




}
