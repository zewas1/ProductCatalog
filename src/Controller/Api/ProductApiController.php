<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\ProductService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[
    Route('/api')
]
class ProductApiController extends AbstractController
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
     * @param int $id
     * @return Response
     */
    #[
        Route('/items/{id}', methods: 'GET')
    ]
    public function getProductById(int $id): Response
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($product);
    }
}
