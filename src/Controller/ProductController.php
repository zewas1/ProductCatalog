<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Form\ProductCategoryType;
use App\Form\ProductType;
use App\Model\ProductModel;
use ProductSaveHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    /**
     * @return Response
     */
    #[Route('/product/list', name: 'app_product_list', methods: 'GET')]
    public function list(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/api/items/{id}', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found'
            );
        }

        return $this->json($product);
    }

    #[Route('/api/product', methods: 'POST')]
    /**
     * @param ProductModel $productModel
     * @param ProductSaveHandler $productSaveHandler
     * @return ProductModel
     */
    public function createProduct(ProductModel $productModel, ProductSaveHandler $productSaveHandler): ProductModel
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $productSaveHandler->buildProduct($productModel);

        $entityManager->persist($entity);
        $entityManager->flush();

        return $productModel;
    }


    /**
     * @Route("/product", name="app_product")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function productController(Request $request): RedirectResponse|Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->uploadToDb($product);

            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/product/category", name="app_product_category")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function productCategoryController(Request $request): RedirectResponse|Response
    {
        $productCategory = new ProductCategory();

        $form = $this->createForm(ProductCategoryType::class, $productCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->uploadToDb($productCategory);

            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/productCategoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param $entity
     */
    private function uploadToDb($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }

}
