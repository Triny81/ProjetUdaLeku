<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponsableLegalRepository")
 * @UniqueEntity(fields={"nom","prenom"}, message="Ce responsable a déjà été enregistré !")
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du responsable légal n'est pas renseigné !")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom du responsable légal n'est pas renseigné !")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le mail du responsable légal n'est pas renseigné !")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_dom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le portable du responsable légal n'est pas renseigné !")
     */
    private $tel_port;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_trav;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enfant", mappedBy="responsable_legal")
     */
    private $enfants;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CorrespondantAdministratif", mappedBy="responsableLegal", cascade={"persist", "remove"})
     */
    private $correspondantAdministratif;

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
            $enfant->setResponsableLegal($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            // set the owning side to null (unless already changed)
            if ($enfant->getResponsableLegal() === $this) {
                $enfant->setResponsableLegal(null);
            }
        }

        return $this;
    }

    public function getCorrespondantAdministratif(): ?CorrespondantAdministratif
    {
        return $this->correspondantAdministratif;
    }

    public function setCorrespondantAdministratif(?CorrespondantAdministratif $correspondantAdministratif): self
    {
        $this->correspondantAdministratif = $correspondantAdministratif;

        // set (or unset) the owning side of the relation if necessary
        $newResponsableLegal = null === $correspondantAdministratif ? null : $this;
        if ($correspondantAdministratif->getResponsableLegal() !== $newResponsableLegal) {
            $correspondantAdministratif->setResponsableLegal($newResponsableLegal);
        }

        return $this;
    }
}
