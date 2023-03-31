<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
#[UniqueEntity('externalId')]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genus = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(unique: true)]
    private ?int $externalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $family = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $orders = null;

    #[ORM\Column(nullable: true)]
    private ?float $carbohydrates = null;

    #[ORM\Column(nullable: true)]
    private ?float $protein = null;

    #[ORM\Column(nullable: true)]
    private ?float $fat = null;

    #[ORM\Column(nullable: true)]
    private ?float $calories = null;

    #[ORM\Column(nullable: true)]
    private ?float $sugar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;

        return $this;
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

    public function getExternalId(): ?int
    {
        return $this->externalId;
    }

    public function setExternalId(int $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(?string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getOrders(): ?string
    {
        return $this->orders;
    }

    public function setOrders(?string $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(?float $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(?float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFat(): ?float
    {
        return $this->fat;
    }

    public function setFat(?float $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getCalories(): ?float
    {
        return $this->calories;
    }

    public function setCalories(?float $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getSugar(): ?float
    {
        return $this->sugar;
    }

    public function setSugar(?float $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }
}
