<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnfantRepository")
 */
class Enfant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code_postal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement", inversedBy="enfants")
     */
    private $etablissement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Centre", inversedBy="enfants")
     */
    private $centre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sejour", inversedBy="enfants")
     */
    private $sejour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ResponsableLegal", inversedBy="enfants")
     */
    private $responsable_legal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CorrespondantAdministratif", inversedBy="enfants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $correspondant_administratif;

    public function __construct()
    {
        $this->responsable_legal = new ArrayCollection();
        $this->sejour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse_1;
    }

    public function setAdresse1(string $adresse_1): self
    {
        $this->adresse_1 = $adresse_1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse_2;
    }

    public function setAdresse2(?string $adresse_2): self
    {
        $this->adresse_2 = $adresse_2;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getCentre(): ?Centre
    {
        return $this->centre;
    }

    public function setCentre(?Centre $centre): self
    {
        $this->centre = $centre;

        return $this;
    }

    /**
     * @return Collection|Sejour[]
     */
    public function getSejour(): Collection
    {
        return $this->sejour;
    }

    public function addSejour(Sejour $sejour): self
    {
        if (!$this->sejour->contains($sejour)) {
            $this->sejour[] = $sejour;
        }

        return $this;
    }

    public function removeSejour(Sejour $sejour): self
    {
        if ($this->sejour->contains($sejour)) {
            $this->sejour->removeElement($sejour);
        }

        return $this;
    }

    public function getResponsableLegal(): ?ResponsableLegal
    {
        return $this->responsable_legal;
    }

    public function setResponsableLegal(?ResponsableLegal $responsable_legal): self
    {
        $this->responsable_legal = $responsable_legal;

        return $this;
    }

    public function getCorrespondantAdministratif(): ?CorrespondantAdministratif
    {
        return $this->correspondant_administratif;
    }

    public function setCorrespondantAdministratif(?CorrespondantAdministratif $correspondant_administratif): self
    {
        $this->correspondant_administratif = $correspondant_administratif;

        return $this;
    }
}
