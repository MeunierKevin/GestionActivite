<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlImage;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="images")
     */
    private $projet;

    /**
     * @ORM\ManyToOne(targetEntity=TypeImage::class, inversedBy="image")
     */
    private $typeImage;

    /**
     * @Vich\UploadableField(mapping="images_projet", fileNameProperty="imageFile")
     */
    private $imageFile;

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        return$this;

        /* if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        } */
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): self
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getTypeImage(): ?TypeImage
    {
        return $this->typeImage;
    }

    public function setTypeImage(?TypeImage $typeImage): self
    {
        $this->typeImage = $typeImage;

        return $this;
    }
}
