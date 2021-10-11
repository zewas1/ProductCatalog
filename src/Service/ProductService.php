<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    private ProductRepository $productRepository;
    private ProductCategoryRepository $categoryRepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct
    (
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        ProductCategoryRepository $categoryRepository,
    ){
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $entity
     */
    public function save($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     * @param Product|ProductCategory $product
     * @return bool
     */
    public function handleProductForm(FormInterface $form, Request $request, Product|ProductCategory $product): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($product);

            return true;
        }

        return false;
    }

    /**
     * @return Product[]|null
     */
    public function listProducts(): ?array
    {
        return $this->productRepository->findAll();
    }

}