<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SerieRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
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

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: Saison::class, orphanRemoval: true)]
    private Collection $Saisons;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'series')]
    private Collection $Genres;

    #[Vich\UploadableField(mapping: 'serie_images', fileNameProperty:'serieImageName')]
    private ?File $serieImageFile = null;

    #[ORM\Column(type:'string', nullable:true)]
    private ?string $serieImageName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->Saisons = new ArrayCollection();
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

    /**
     * @return Collection<int, Saison>
     */
    public function getSaisons(): Collection
    {
        return $this->Saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->Saisons->contains($saison)) {
            $this->Saisons->add($saison);
            $saison->setSerie($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->Saisons->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getSerie() === $this) {
                $saison->setSerie(null);
            }
        }

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
    public function getserieImageFile()
    {
        return $this->serieImageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setserieImageFile(?File $serieImageFile= null):void
    {
        $this->serieImageFile = $serieImageFile;

        if(null !== $serieImageFile){
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    /**
     * Get the value of imageName
     */ 
    public function getserieImageName()
    {
        return $this->serieImageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setserieImageName($serieImageName)
    {
        $this->serieImageName = $serieImageName;

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

    public function __toString()
    {
        return $this->title;
    }
    
}
