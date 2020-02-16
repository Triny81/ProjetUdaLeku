<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponsableLegalRepository")
 */
class ResponsableLegal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tel_dom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel_port;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tel_trav;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelDom(): ?string
    {
        return $this->tel_dom;
    }

    public function setTelDom(?string $tel_dom): self
    {
        $this->tel_dom = $tel_dom;

        return $this;
    }

    public function getTelPort(): ?string
    {
        return $this->tel_port;
    }

    public function setTelPort(string $tel_port): self
    {
        $this->tel_port = $tel_port;

        return $this;
    }

    public function getTelTrav(): ?string
    {
        return $this->tel_trav;
    }

    public function setTelTrav(?string $tel_trav): self
    {
        $this->tel_trav = $tel_trav;

        return $this;
    }
}
