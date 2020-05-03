<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnfantRepository")
 * @UniqueEntity(fields={"nom","prenom","dateNaiss"}, message="Cet enfant est déjà enregistré !")
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
     * @Assert\NotBlank(message="Le nom de l'enfant n'est pas renseigné !")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom de l'enfant n'est pas renseigné !")
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Le date de naissance de l'enfant n'est pas renseignée !")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse de l'enfant n'est pas renseignée !")
     */
    private $adresse_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_2;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La ville où habite l'enfant n'est pas renseignée !")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Le code postal n'est pas renseigné !")
     */
    private $code_postal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement", inversedBy="enfants", cascade={"persist"})
     */
    private $etablissement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Centre", inversedBy="enfants")
     * @Assert\NotBlank(message="Le centre où doit être inscrit l'enfant n'est pas renseigné !")
     */
    private $centre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sejour", inversedBy="enfants")
     */
    private $sejour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ResponsableLegal", inversedBy="enfants", cascade={"persist"})
     */
    private $responsable_legal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CorrespondantAdministratif", inversedBy="enfants", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $correspondant_administratif;

    /**
     * @Assert\Valid
     */
    private $new_etablissement;

    /**
     * @Assert\Valid
     */
    private $new_correspondantAdministratif;

    /**
     * @Assert\Valid
     */
    private $new_responsableLegal;

    /**
     * @Assert\IsFalse(message="Un même responsable ne peut avoir deux rôles à la fois !")
     */
    public function isCorrespAsSameAsResp(){
        return $this->getResponsableLegal() === $this->getCorrespondantAdministratif()->getResponsableLegal();
    }

    public function __construct()
    {
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

    public function getNewEtablissement(): ?Etablissement
    {
        return $this->new_etablissement;
    }

    public function setNewEtablissement(?Etablissement $new_etablissement): self
    {
        $this->new_etablissement = $new_etablissement;

        return $this;
    }

    public function getNewCorrespondantAdministratif(): ?CorrespondantAdministratif
    {
        return $this->new_correspondantAdministratif;
    }

    public function setNewCorrespondantAdministratif(?CorrespondantAdministratif $new_correspondantAdministratif): self
    {
        $this->new_correspondantAdministratif = $new_correspondantAdministratif;

        return $this;
    }

    public function getNewResponsableLegal(): ?ResponsableLegal
    {
        return $this->new_responsableLegal;
    }

    public function setNewResponsableLegal(?ResponsableLegal $new_responsableLegal): self
    {
        $this->new_responsableLegal = $new_responsableLegal;

        return $this;
    }
}
