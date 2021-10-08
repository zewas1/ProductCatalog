<?php

declare(strict_types=1);

namespace App\Model;

class ProductModel
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var ProductCategoryModel
     */
    private ProductCategoryModel $productCategory;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ProductCategoryModel
     */
    public function getProductCategory(): ProductCategoryModel
    {
        return $this->productCategory;
    }

    /**
     * @param ProductCategoryModel $productCategory
     */
    public function setProductCategory(ProductCategoryModel $productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}