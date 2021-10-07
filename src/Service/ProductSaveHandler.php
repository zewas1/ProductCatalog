<?php

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Model\ProductCategoryModel;
use App\Model\ProductModel;

class ProductSaveHandler
{
    /**
     * @param ProductModel $productModel
     *
     * @return Product
     */
    public function buildProduct(ProductModel $productModel): Product
    {
        $entity = new Product();
        $entity->setName($productModel->getName());
        $entity->setProductCategory($productModel->getProductCategory());
        $entity->setDescription($productModel->getDescription());
        $entity->setPrice($productModel->getPrice());
        $entity->setQuantity($productModel->getQuantity());

        return $entity;
    }

    /**
     * @param ProductCategoryModel $productCategoryModel
     *
     * @return ProductCategory
     */
    private function buildProductCategory(ProductCategoryModel $productCategoryModel): ProductCategory
    {
        $entity = new ProductCategory();
        $entity->setName($productCategoryModel->getName());

        return $entity;
    }
}