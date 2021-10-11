<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Form\ProductCategoryType;
use App\Form\ProductType;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\ORMException;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    private ProductRepository $productRepository;
    private ProductService $productService;

    public function __construct
    (
        ProductRepository $productRepository,
        ProductService    $productService,
    ) {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * @return Response
     */
    #[Route('/products', name: 'app_product_list', methods: 'GET')]
    public function listProducts(): Response
    {
        $products = $this->productService->listProducts();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    #[Route('/api/items/{id}', methods: 'GET')]
    public function showOneProduct(int $id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        return $this->json($product);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    #[Route('/products/create', name: 'app_product')]
    public function createProduct(Request $request): RedirectResponse|Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $handler = $this->productService->handleProductForm($form, $request, $product);

        if ($handler) {
            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    #[Route('/products/category', name: 'app_product_category')]
    public function createProductCategory(Request $request): RedirectResponse|Response
    {
        $productCategory = new ProductCategory();

        $form = $this->createForm(ProductCategoryType::class, $productCategory);

        $handler = $this->productService->handleProductForm($form, $request, $productCategory);

        if ($handler) {
            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productCategoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
