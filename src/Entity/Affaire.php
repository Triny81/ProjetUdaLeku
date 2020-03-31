<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffaireRepository")
 * @UniqueEntity(fields={"nom_francais"}, message="Cette affaire existe déjà !")
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
     * @Assert\NotBlank
     * @Assert\Length(max = 40,
     *                maxMessage = "Les noms ne peuvent pas dépasser les {{ limit }} caractères !")
     * @Assert\Regex(pattern="/[0-9]+/i",
     *              match=false,
     *              message = "On ne peux pas créer une affaire avec des chiffres !")
     */
    private $nom_francais;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     * @Assert\Length(max = 40,
     *                maxMessage = "Les noms ne peuvent pas dépasser les {{ limit }} caractères !"))
     * @Assert\Regex(pattern="/[0-9]+/i",
     *              match=false,
     *              message = "On ne peux pas créer une affaire avec des chiffres !")
     */
    private $nom_basque;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ListeAffaire", inversedBy="affaire")
     */
    private $listeAffaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAffaire", inversedBy="affaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_affaire;

    public function __construct()
    {
        $this->listeAffaire = new ArrayCollection();
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

    public function getTypeAffaire(): ?TypeAffaire
    {
        return $this->type_affaire;
    }

    public function setTypeAffaire(?TypeAffaire $type_affaire): self
    {
        $this->type_affaire = $type_affaire;

        return $this;
    }

    /**
     * @return Collection|ListeAffaire[]
     */
    public function getListeAffaire(): Collection
    {
        return $this->listeAffaire;
    }

    public function addListeAffaire(ListeAffaire $listeAffaire): self
    {
        if (!$this->listeAffaire->contains($listeAffaire)) {
            $this->listeAffaire[] = $listeAffaire;
        }

        return $this;
    }

    public function removeListeAffaire(ListeAffaire $listeAffaire): self
    {
        if ($this->listeAffaire->contains($listeAffaire)) {
            $this->listeAffaire->removeElement($listeAffaire);
        }

        return $this;
    }
}
