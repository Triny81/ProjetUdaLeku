<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorrespondantAdministratifRepository")
 */
class CorrespondantAdministratif
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
    private $num_secu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aide_caf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aide_msa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aide_autres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enfant", mappedBy="correspondant_administratif")
     */
    private $fk_enfants;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ResponsableLegal", inversedBy="correspondantAdministratif", cascade={"persist", "remove"})
     */
    private $responsableLegal;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSecu(): ?string
    {
        return $this->num_secu;
    }

    public function setNumSecu(string $num_secu): self
    {
        $this->num_secu = $num_secu;

        return $this;
    }

    public function getAideCaf(): ?string
    {
        return $this->aide_caf;
    }

    public function setAideCaf(string $aide_caf): self
    {
        $this->aide_caf = $aide_caf;

        return $this;
    }

    public function getAideMsa(): ?string
    {
        return $this->aide_msa;
    }

    public function setAideMsa(string $aide_msa): self
    {
        $this->aide_msa = $aide_msa;

        return $this;
    }

    public function getAideAutres(): ?string
    {
        return $this->aide_autres;
    }

    public function setAideAutres(string $aide_autres): self
    {
        $this->aide_autres = $aide_autres;

        return $this;
    }

    /**
     * @return Collection|Enfant[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfant $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setCorrespondantAdministratif($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            // set the owning side to null (unless already changed)
            if ($enfant->getCorrespondantAdministratif() === $this) {
                $enfant->setCorrespondantAdministratif(null);
            }
        }

        return $this;
    }

    public function getResponsableLegal(): ?ResponsableLegal
    {
        return $this->responsableLegal;
    }

    public function setResponsableLegal(?ResponsableLegal $responsableLegal): self
    {
        $this->responsableLegal = $responsableLegal;

        return $this;
    }
}
