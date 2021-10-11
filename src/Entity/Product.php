<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Type("int")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Name must not be blank")
     *
     * @JMS\Type("string")
     */
    private string $name;

    /**
     * @var ProductCategory
     *
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     *
     * @JMS\Type("ProductCategory")
     *
     * @Assert\Valid()
     */
    private ProductCategory $productCategory;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     *
     * @JMS\Type("float")
     *
     * @Assert\NotBlank(message="Price must not be blank")
     */
    private float $price;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     *
     * @JMS\Type("int")
     */
    private int $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @JMS\Type("string")
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
     * @return ProductCategory
     */
    public function getProductCategory(): ProductCategory
    {
        return $this->productCategory;
    }

    /**
     * @param ProductCategory $productCategory
     */
    public function setProductCategory(ProductCategory $productCategory): void
    {
        $this->productCategory = $productCategory;
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
     */
    public function setDescription(?string $description): void
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