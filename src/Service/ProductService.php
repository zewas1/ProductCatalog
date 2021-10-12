<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Form\ProductType;
use App\Form\ProductCategoryType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ProductRepository $productRepository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct
    (
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        FormFactoryInterface $formFactory
    ) {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @return FormInterface
     */
    public function handleProduct(Request $request): FormInterface
    {
        $product = new Product();

        $form = $this->handleFormData(ProductType::class, $request, $product);

        if ($form->isSubmitted() && $form->isValid()) {
           $this->entityManager->persist($product);
           $this->entityManager->flush();
        }

        return $form;
    }

    /**
     * @param Request $request
     * @return FormInterface
     */
    public function handleProductCategory(Request $request): FormInterface
    {
        $productCategory = new ProductCategory();
        $form = $this->handleFormData(ProductCategoryType::class, $request, $productCategory);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($productCategory);
            $this->entityManager->flush();
        }

        return $form;
    }

    /**
     * @return Product[]|null
     */
    public function listProducts(): ?array
    {
        return $this->productRepository->findAll();
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param string $type
     * @param Request $request
     * @param Object|null $data
     * @return FormInterface
     */
    private function handleFormData(string $type, Request $request, object $data = null): FormInterface
    {
        $form = $this->formFactory->create($type, $data);
        $form->handleRequest($request);

        return $form;
    }
}
