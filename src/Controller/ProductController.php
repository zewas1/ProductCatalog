<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Response
     */
    #[
        Route('/products', name: 'app_product_list', methods: 'GET')
    ]
    public function listProducts(): Response
    {
        $products = $this->productService->listProducts();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[
        Route('/products/create', name: 'app_product')
    ]
    public function createProduct(Request $request): Response
    {
        $form = $this->productService->handleProduct($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @param Request $request
     * @return Response
     */
    #[
        Route('/products/category', name: 'app_product_category')
    ]
    public function createProductCategory(Request $request): Response
    {
        $form = $this->productService->handleProductCategory($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productCategoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
