<?php

namespace App\Entity;

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
}
