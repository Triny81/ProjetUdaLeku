<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorrespondantAdministratifRepository")
 */
class CorrespondantAdministratif extends ResponsableLegal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $n°_secu;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getN°Secu(): ?string
    {
        return $this->n°_secu;
    }

    public function setN°Secu(string $n°_secu): self
    {
        $this->n°_secu = $n°_secu;

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
}
