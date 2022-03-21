<?php

namespace App\Entity;

use App\Repository\ContentInvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentInvoiceRepository::class)]
class ContentInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'contentInvoice', targetEntity: Invoice::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice;

    #[ORM\Column(type: 'string', length: 100)]
    private $product_name;

    #[ORM\Column(type: 'integer')]
    private $price_product;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_product;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getPriceProduct(): ?int
    {
        return $this->price_product;
    }

    public function setPriceProduct(int $price_product): self
    {
        $this->price_product = $price_product;

        return $this;
    }

    public function getImageProduct(): ?string
    {
        return $this->image_product;
    }

    public function setImageProduct(string $image_product): self
    {
        $this->image_product = $image_product;

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
        return $this->getPriceProduct() * $this->getQuantity();
    }
}

