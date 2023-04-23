<?php

namespace App\Entity;

use App\Repository\DocumentaireRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentaireRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Documentaire
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
    #[Assert\Length(min:6, max:50)]
    private ?string $duration = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\Positive()]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min:3, max:255)]
    private ?string $description = null;

    #[Vich\UploadableField(mapping: 'documentaire_images', fileNameProperty:'documentaireImageName')]
    private ?File $documentaireImageFile = null;

    #[ORM\Column(type:'string', nullable:true)]
    private ?string $documentaireImageName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getdocumentaireImageFile()
    {
        return $this->documentaireImageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setdocumentaireImageFile(?File $documentaireImageFile= null):void
    {
        $this->documentaireImageFile = $documentaireImageFile;

        if(null !== $documentaireImageFile){
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    /**
     * Get the value of imageName
     */ 
    public function getdocumentaireImageName()
    {
        return $this->documentaireImageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setdocumentaireImageName($documentaireImageName)
    {
        $this->documentaireImageName = $documentaireImageName;

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
