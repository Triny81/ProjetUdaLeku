<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListeAffaireRepository")
 */
class ListeAffaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom_français;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom_basque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sejour", mappedBy="listeAffaire")
     */
    private $sejour;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Affaire", inversedBy="listeAffaires")
     */
    private $affaire;

    public function __construct()
    {
        $this->sejour = new ArrayCollection();
        $this->affaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFrançais(): ?string
    {
        return $this->nom_français;
    }

    public function setNomFrançais(string $nom_français): self
    {
        $this->nom_français = $nom_français;

        return $this;
    }

    public function getNomBasque(): ?string
    {
        return $this->nom_basque;
    }

    public function setNomBasque(string $nom_basque): self
    {
        $this->nom_basque = $nom_basque;

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
            $sejour->setListeAffaire($this);
        }

        return $this;
    }

    public function removeSejour(Sejour $sejour): self
    {
        if ($this->sejour->contains($sejour)) {
            $this->sejour->removeElement($sejour);
            // set the owning side to null (unless already changed)
            if ($sejour->getListeAffaire() === $this) {
                $sejour->setListeAffaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affaire[]
     */
    public function getAffaire(): Collection
    {
        return $this->affaire;
    }

    public function addAffaire(Affaire $affaire): self
    {
        if (!$this->affaire->contains($affaire)) {
            $this->affaire[] = $affaire;
        }

        return $this;
    }

    public function removeAffaire(Affaire $affaire): self
    {
        if ($this->affaire->contains($affaire)) {
            $this->affaire->removeElement($affaire);
        }

        return $this;
    }
}
