<?php

namespace App\Entity;

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
