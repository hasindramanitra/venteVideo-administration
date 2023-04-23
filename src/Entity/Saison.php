<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:3, max:50)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Saisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Serie $serie = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:3)]
    #[Assert\NotBlank()]
    private ?string $durationEachEpisode = null;

   

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

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDurationEachEpisode(): ?string
    {
        return $this->durationEachEpisode;
    }

    public function setDurationEachEpisode(string $durationEachEpisode): self
    {
        $this->durationEachEpisode = $durationEachEpisode;

        return $this;
    }

   
}
