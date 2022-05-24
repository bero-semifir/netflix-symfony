<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $producteur;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $nombre_episodes;

    #[ORM\Column(type: 'date')]
    private $date_sortie;

    #[ORM\ManyToMany(targetEntity: Univers::class, inversedBy: 'series')]
    private $Univers;

    public function __construct()
    {
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNombreEpisodes(): ?int
    {
        return $this->nombre_episodes;
    }

    public function setNombreEpisodes(int $nombre_episodes): self
    {
        $this->nombre_episodes = $nombre_episodes;

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
        return $this->getTitre();
    }
}
