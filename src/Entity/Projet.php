<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $analyseExistant;

    /**
     * @ORM\Column(type="text")
     */
    private $objectifsDuSite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cibles;

    /**
     * @ORM\Column(type="text")
     */
    private $fonctionnalites;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $charteGraphique;

    /**
     * @ORM\Column(type="text")
     */
    private $contenuDuSite;

    /**
     * @ORM\Column(type="text")
     */
    private $maquettage;

    /**
     * @ORM\Column(type="text")
     */
    private $contraintesTechniques;

    /**
     * @ORM\Column(type="text")
     */
    private $prestationsDevis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMaquette;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeveloppement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTests;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMiseEnLigne;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="projet")
     */
    private $images;


    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProjet::class, inversedBy="projet")
     */
    private $typeProjet;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnalyseExistant(): ?string
    {
        return $this->analyseExistant;
    }

    public function setAnalyseExistant(string $analyseExistant): self
    {
        $this->analyseExistant = $analyseExistant;

        return $this;
    }

    public function getObjectifsDuSite(): ?string
    {
        return $this->objectifsDuSite;
    }

    public function setObjectifsDuSite(string $objectifsDuSite): self
    {
        $this->objectifsDuSite = $objectifsDuSite;

        return $this;
    }

    public function getCibles(): ?string
    {
        return $this->cibles;
    }

    public function setCibles(string $cibles): self
    {
        $this->cibles = $cibles;

        return $this;
    }

    public function getFonctionnalites(): ?string
    {
        return $this->fonctionnalites;
    }

    public function setFonctionnalites(string $fonctionnalites): self
    {
        $this->fonctionnalites = $fonctionnalites;

        return $this;
    }

    public function getCharteGraphique(): ?string
    {
        return $this->charteGraphique;
    }

    public function setCharteGraphique(string $charteGraphique): self
    {
        $this->charteGraphique = $charteGraphique;

        return $this;
    }

    public function getContenuDuSite(): ?string
    {
        return $this->contenuDuSite;
    }

    public function setContenuDuSite(string $contenuDuSite): self
    {
        $this->contenuDuSite = $contenuDuSite;

        return $this;
    }

    public function getMaquettage(): ?string
    {
        return $this->maquettage;
    }

    public function setMaquettage(string $maquettage): self
    {
        $this->maquettage = $maquettage;

        return $this;
    }

    public function getContraintesTechniques(): ?string
    {
        return $this->contraintesTechniques;
    }

    public function setContraintesTechniques(string $contraintesTechniques): self
    {
        $this->contraintesTechniques = $contraintesTechniques;

        return $this;
    }

    public function getPrestationsDevis(): ?string
    {
        return $this->prestationsDevis;
    }

    public function setPrestationsDevis(string $prestationsDevis): self
    {
        $this->prestationsDevis = $prestationsDevis;

        return $this;
    }

    public function getDateMaquette(): ?\DateTimeInterface
    {
        return $this->dateMaquette;
    }

    public function setDateMaquette(\DateTimeInterface $dateMaquette): self
    {
        $this->dateMaquette = $dateMaquette;

        return $this;
    }

    public function getDateDeveloppement(): ?\DateTimeInterface
    {
        return $this->dateDeveloppement;
    }

    public function setDateDeveloppement(\DateTimeInterface $dateDeveloppement): self
    {
        $this->dateDeveloppement = $dateDeveloppement;

        return $this;
    }

    public function getDateTests(): ?\DateTimeInterface
    {
        return $this->dateTests;
    }

    public function setDateTests(\DateTimeInterface $dateTests): self
    {
        $this->dateTests = $dateTests;

        return $this;
    }

    public function getDateMiseEnLigne(): ?\DateTimeInterface
    {
        return $this->dateMiseEnLigne;
    }

    public function setDateMiseEnLigne(\DateTimeInterface $dateMiseEnLigne): self
    {
        $this->dateMiseEnLigne = $dateMiseEnLigne;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProjet($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProjet() === $this) {
                $image->setProjet(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTypeProjet(): ?TypeProjet
    {
        return $this->typeProjet;
    }

    public function setTypeProjet(?TypeProjet $typeProjet): self
    {
        $this->typeProjet = $typeProjet;

        return $this;
    }
}
