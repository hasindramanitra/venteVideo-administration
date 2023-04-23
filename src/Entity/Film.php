<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:3, max:50)]
    private ?string $title = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    private ?string $anneeDeSortie = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:3, max:50)]
    private ?string $duration = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Positive()]
    private ?float $price = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'films')]
    private Collection $Genres;

    #[Vich\UploadableField(mapping: 'film_images', fileNameProperty:'filmImageName')]
    private ?File $filmImageFile = null;

    #[ORM\Column(type:'string', nullable:true)]
    private ?string $filmImageName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->Genres = new ArrayCollection();
        $this->updatedAt = new DateTimeImmutable();
    }

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

    public function getAnneeDeSortie(): ?string
    {
        return $this->anneeDeSortie;
    }

    public function setAnneeDeSortie(string $anneeDeSortie): self
    {
        $this->anneeDeSortie = $anneeDeSortie;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->Genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->Genres->contains($genre)) {
            $this->Genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->Genres->removeElement($genre);

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getfilmImageFile()
    {
        return $this->filmImageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setfilmImageFile(?File $filmImageFile= null):void
    {
        $this->filmImageFile = $filmImageFile;

        if(null !== $filmImageFile){
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    /**
     * Get the value of imageName
     */ 
    public function getfilmImageName()
    {
        return $this->filmImageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setfilmImageName($filmImageName)
    {
        $this->filmImageName = $filmImageName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
