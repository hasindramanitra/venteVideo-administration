<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:3, max:50)]
    private ?string $title = null;

  

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $authors = null;

    #[ORM\Column(length: 6)]
    #[Assert\NotBlank()]
    private ?string $anneeDeSortie = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Assert\NotBlank()]
    private ?float $priceBySeason = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthors(): ?string
    {
        return $this->authors;
    }

    public function setAuthors(string $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    public function getAnneeDeSortie(): ?string
    {
        return $this->anneeDeSortie;
    }

    public function setAnneeDeSortie(string $anneeDeSortie): self
    {
        $this->anneeDeSortie = $anneeDeSortie;

        return $this;
    }

    public function getPriceBySeason(): ?float
    {
        return $this->priceBySeason;
    }

    public function setPriceBySeason(float $priceBySeason): self
    {
        $this->priceBySeason = $priceBySeason;

        return $this;
    }
}
