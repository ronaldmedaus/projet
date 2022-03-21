<?php

namespace App\Entity;

use App\Repository\ProductSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductSizeRepository::class)]
class ProductSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productSizes')]
    private $product;

    #[ORM\Column(type: 'boolean')]
    private $is_27;

    #[ORM\Column(type: 'boolean')]
    private $is_28;

    #[ORM\Column(type: 'boolean')]
    private $is_29;

    #[ORM\Column(type: 'boolean')]
    private $is_30;

    #[ORM\Column(type: 'boolean')]
    private $is_31;

    #[ORM\Column(type: 'boolean')]
    private $is_32;

    #[ORM\Column(type: 'boolean')]
    private $is_33;

    #[ORM\Column(type: 'boolean')]
    private $is_34;

    #[ORM\Column(type: 'boolean')]
    private $is_35;

    #[ORM\Column(type: 'boolean')]
    private $is_36;

    #[ORM\Column(type: 'boolean')]
    private $is_37;

    #[ORM\Column(type: 'boolean')]
    private $is_38;

    #[ORM\Column(type: 'boolean')]
    private $is_39;

    #[ORM\Column(type: 'boolean')]
    private $is_40;

    #[ORM\Column(type: 'boolean')]
    private $is_41;

    #[ORM\Column(type: 'boolean')]
    private $is_42;

    #[ORM\Column(type: 'boolean')]
    private $is_43;

    #[ORM\Column(type: 'boolean')]
    private $is_44;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->product->removeElement($product);

        return $this;
    }

    public function getIs27(): ?bool
    {
        return $this->is_27;
    }

    public function setIs27(bool $is_27): self
    {
        $this->is_27 = $is_27;

        return $this;
    }

    public function getIs28(): ?bool
    {
        return $this->is_28;
    }

    public function setIs28(bool $is_28): self
    {
        $this->is_28 = $is_28;

        return $this;
    }

    public function getIs29(): ?bool
    {
        return $this->is_29;
    }

    public function setIs29(bool $is_29): self
    {
        $this->is_29 = $is_29;

        return $this;
    }

    public function getIs30(): ?bool
    {
        return $this->is_30;
    }

    public function setIs30(bool $is_30): self
    {
        $this->is_30 = $is_30;

        return $this;
    }

    public function getIs31(): ?bool
    {
        return $this->is_31;
    }

    public function setIs31(bool $is_31): self
    {
        $this->is_31 = $is_31;

        return $this;
    }

    public function getIs32(): ?bool
    {
        return $this->is_32;
    }

    public function setIs32(bool $is_32): self
    {
        $this->is_32 = $is_32;

        return $this;
    }

    public function getIs33(): ?bool
    {
        return $this->is_33;
    }

    public function setIs33(bool $is_33): self
    {
        $this->is_33 = $is_33;

        return $this;
    }

    public function getIs34(): ?bool
    {
        return $this->is_34;
    }

    public function setIs34(bool $is_34): self
    {
        $this->is_34 = $is_34;

        return $this;
    }

    public function getIs35(): ?bool
    {
        return $this->is_35;
    }

    public function setIs35(bool $is_35): self
    {
        $this->is_35 = $is_35;

        return $this;
    }

    public function getIs36(): ?bool
    {
        return $this->is_36;
    }

    public function setIs36(bool $is_36): self
    {
        $this->is_36 = $is_36;

        return $this;
    }

    public function getIs37(): ?bool
    {
        return $this->is_37;
    }

    public function setIs37(bool $is_37): self
    {
        $this->is_37 = $is_37;

        return $this;
    }

    public function getIs38(): ?bool
    {
        return $this->is_38;
    }

    public function setIs38(bool $is_38): self
    {
        $this->is_38 = $is_38;

        return $this;
    }

    public function getIs39(): ?bool
    {
        return $this->is_39;
    }

    public function setIs39(bool $is_39): self
    {
        $this->is_39 = $is_39;

        return $this;
    }

    public function getIs40(): ?bool
    {
        return $this->is_40;
    }

    public function setIs40(bool $is_40): self
    {
        $this->is_40 = $is_40;

        return $this;
    }

    public function getIs41(): ?bool
    {
        return $this->is_41;
    }

    public function setIs41(bool $is_41): self
    {
        $this->is_41 = $is_41;

        return $this;
    }

    public function getIs42(): ?bool
    {
        return $this->is_42;
    }

    public function setIs42(bool $is_42): self
    {
        $this->is_42 = $is_42;

        return $this;
    }

    public function getIs43(): ?bool
    {
        return $this->is_43;
    }

    public function setIs43(bool $is_43): self
    {
        $this->is_43 = $is_43;

        return $this;
    }

    public function getIs44(): ?bool
    {
        return $this->is_44;
    }

    public function setIs44(bool $is_44): self
    {
        $this->is_44 = $is_44;

        return $this;
    }
}
