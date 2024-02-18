<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixU = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixT = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: Product::class)]
    private Collection $idP;

    #[ORM\OneToOne(inversedBy: 'panier', cascade: ['persist', 'remove'])]
    private ?User $idC = null;

    public function __construct()
    {
        $this->idP = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixU(): ?int
    {
        return $this->prixU;
    }

    public function setPrixU(?int $prixU): static
    {
        $this->prixU = $prixU;

        return $this;
    }

    public function getPrixT(): ?int
    {
        return $this->prixT;
    }

    public function setPrixT(?int $prixT): static
    {
        $this->prixT = $prixT;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getIdP(): Collection
    {
        return $this->idP;
    }

    public function addIdP(Product $idP): static
    {
        if (!$this->idP->contains($idP)) {
            $this->idP->add($idP);
            $idP->setPanier($this);
        }

        return $this;
    }

    public function removeIdP(Product $idP): static
    {
        if ($this->idP->removeElement($idP)) {
            // set the owning side to null (unless already changed)
            if ($idP->getPanier() === $this) {
                $idP->setPanier(null);
            }
        }

        return $this;
    }

    public function getIdC(): ?User
    {
        return $this->idC;
    }

    public function setIdC(?User $idC): static
    {
        $this->idC = $idC;

        return $this;
    }

    public function __toString()
    {
        // Example: Return the ID of the Panier as a string
        return strval($this->id);
    }
}
