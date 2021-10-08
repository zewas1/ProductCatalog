<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Name must not be blank")
     *
     * @var string|null
     */
    private ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class)
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid()
     *
     * @var ProductCategory
     */
    private ProductCategory $productCategory;

    /**
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank(message="Price must not be blank")
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
    public function setProductCategory(ProductCategory $productCategory): self
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->name,
            'productCategory' => [
                'id' => $this->productCategory->getId(),
                'name' => $this->productCategory->getName(),
            ],
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
        ];
    }
}