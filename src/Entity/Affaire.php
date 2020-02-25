<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffaireRepository")
 */
class Affaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom_francais;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom_basque;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ListeAffaire", mappedBy="affaire")
     */
    private $listeAffaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAffaire", inversedBy="affaires")
     */
    private $type_affaire;

    public function __construct()
    {
        $this->listeAffaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFrancais(): ?string
    {
        return $this->nom_francais;
    }

    public function setNomFrancais(string $nom_francais): self
    {
        $this->nom_francais = $nom_francais;

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
     * @return Collection|ListeAffaire[]
     */
    public function getListeAffaires(): Collection
    {
        return $this->listeAffaires;
    }

    public function addListeAffaire(ListeAffaire $listeAffaire): self
    {
        if (!$this->listeAffaires->contains($listeAffaire)) {
            $this->listeAffaires[] = $listeAffaire;
            $listeAffaire->addAffaire($this);
        }

        return $this;
    }

    public function removeListeAffaire(ListeAffaire $listeAffaire): self
    {
        if ($this->listeAffaires->contains($listeAffaire)) {
            $this->listeAffaires->removeElement($listeAffaire);
            $listeAffaire->removeAffaire($this);
        }

        return $this;
    }

    public function getTypeAffaire(): ?TypeAffaire
    {
        return $this->type_affaire;
    }

    public function setTypeAffaire(?TypeAffaire $type_affaire): self
    {
        $this->type_affaire = $type_affaire;

        return $this;
    }
}
