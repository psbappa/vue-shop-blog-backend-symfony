<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
#[ApiResource]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $hexColor;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'colors')]
    private $colors;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHexColor(): ?string
    {
        return $this->hexColor;
    }

    public function setHexColor(string $hexColor): self
    {
        $this->hexColor = $hexColor;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Product $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
            $color->addColor($this);
        }

        return $this;
    }

    public function removeColor(Product $color): self
    {
        if ($this->colors->removeElement($color)) {
            $color->removeColor($this);
        }

        return $this;
    }
}
