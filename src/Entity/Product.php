<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @var string|null
     */
    private ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class)
     * @ORM\JoinColumn(nullable=false)
     *
     * @var ProductCategory
     */
    private ProductCategory $productCategory;

    /**
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     *
     * @var float
     */
    private float $price;

    /**
     * @ORM\Column(name="quantity", type="integer")
     *
     * @var int
     */
    private int $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductCategory
     */
    public function getProductCategory(): ProductCategory
    {
        return $this->productCategory;
    }

    /**
     * @param ProductCategory $productCategory
     * @return $this
     */
    public function setProductCategory (ProductCategory $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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