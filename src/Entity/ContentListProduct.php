<?php

namespace App\Entity;

use App\Entity\Purchase;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContentListProductRepository;

#[ORM\Entity(repositoryClass: ContentListProductRepository::class)]
class ContentListProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'contentListProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    #[ORM\ManyToOne(targetEntity: Purchase::class, inversedBy: 'contentListProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $purchase;

    #[ORM\Column(type: 'integer')]
    private $quantity;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotal()
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }
}
