<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// Validators
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'date')]
    #[Assert\LessThan(
        value:"today",
        message:"Marty! Le film n'a pas pu sortir dans le futur !"
    )]
    private $date_sortie;

    #[ORM\Column(type: 'string', length: 255)]
    private $producteur;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Univers::class, inversedBy: 'films')]
    private $Univers;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
        $this->Univers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getProducteur(): ?string
    {
        return $this->producteur;
    }

    public function setProducteur(string $producteur): self
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Univers>
     */
    public function getUnivers(): Collection
    {
        return $this->Univers;
    }

    public function addUniver(Univers $univer): self
    {
        if (!$this->Univers->contains($univer)) {
            $this->Univers[] = $univer;
        }

        return $this;
    }

    public function removeUniver(Univers $univer): self
    {
        $this->Univers->removeElement($univer);

        return $this;
    }


    public function __toString()
    {
        return $this->getTitre() . ' de ' . $this->getProducteur();
    }

}
