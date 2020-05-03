<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeAffaireRepository")
 */
class TypeAffaire
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
     * @ORM\OneToMany(targetEntity="App\Entity\Affaire", mappedBy="type_affaire")
     */
    private $affaires;

    public function __construct()
    {
        $this->affaires = new ArrayCollection();
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

    /**
     * @return Collection|Affaire[]
     */
    public function getAffaires(): Collection
    {
        return $this->affaires;
    }

    public function addAffaire(Affaire $affaire): self
    {
        if (!$this->affaires->contains($affaire)) {
            $this->affaires[] = $affaire;
            $affaire->setTypeAffaire($this);
        }

        return $this;
    }

    public function removeAffaire(Affaire $affaire): self
    {
        if ($this->affaires->contains($affaire)) {
            $this->affaires->removeElement($affaire);
            // set the owning side to null (unless already changed)
            if ($affaire->getTypeAffaire() === $this) {
                $affaire->setTypeAffaire(null);
            }
        }

        return $this;
    }
}
