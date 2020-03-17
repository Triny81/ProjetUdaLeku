<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorrespondantAdministratifRepository")
 */
class CorrespondantAdministratif extends ResponsableLegal
{	

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $num_secu;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $aide_caf;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $aide_msa;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $aide_autres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enfant", mappedBy="correspondant_administratif", orphanRemoval=true)
     */
    private $fk_enfants;
	



    public function __construct()
    {
        parent::__construct();
        $this->enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
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

    public function setAideCaf(?string $aide_caf): self
    {
        $this->aide_caf = $aide_caf;

        return $this;
    }

    public function getAideMsa(): ?string
    {
        return $this->aide_msa;
    }

    public function setAideMsa(?string $aide_msa): self
    {
        $this->aide_msa = $aide_msa;

        return $this;
    }

    public function getAideAutres(): ?string
    {
        return $this->aide_autres;
    }

    public function setAideAutres(?string $aide_autres): self
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
	
	public function __toString(): string
    {
        return parent::getNom();
    }
}
