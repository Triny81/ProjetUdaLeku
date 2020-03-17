<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponsableLegalRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="correspondant_administratif_id", type="string")
 * @ORM\DiscriminatorMap({"responsable_legal" = "ResponsableLegal", "correspondant_administratif" = "CorrespondantAdministratif"})
 */

class ResponsableLegal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $tel_dom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $tel_port;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $tel_trav;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enfant", mappedBy="responsable_legal")
     */
    private $enfants;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
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
            $enfant->addResponsableLegal($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            $enfant->removeResponsableLegal($this);
        }

        return $this;
    }
}
