<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomDuGroupe = null;

    #[ORM\Column(length: 50)]
    private ?string $origine = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $anneeDebut = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $anneeSeparation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fondateurs = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $members = null;

    #[ORM\ManyToOne(inversedBy: 'groupes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CourantMusical $courantMusical = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentation = null;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuGroupe(): ?string
    {
        return $this->nomDuGroupe;
    }

    public function setNomDuGroupe(string $nomDuGroupe): static
    {
        $this->nomDuGroupe = $nomDuGroupe;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): static
    {
        $this->origine = $origine;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAnneeDebut(): ?int
    {
        return $this->anneeDebut;
    }

    public function setAnneeDebut(int $anneeDebut): static
    {
        $this->anneeDebut = $anneeDebut;

        return $this;
    }

    public function getAnneeSeparation(): ?int
    {
        return $this->anneeSeparation;
    }

    public function setAnneeSeparation(?int $anneeSeparation): static
    {
        $this->anneeSeparation = $anneeSeparation;

        return $this;
    }

    public function getFondateurs(): ?string
    {
        return $this->fondateurs;
    }

    public function setFondateurs(?string $fondateurs): static
    {
        $this->fondateurs = $fondateurs;

        return $this;
    }

    public function getMembers(): ?int
    {
        return $this->members;
    }

    public function setMembers(?int $members): static
    {
        $this->members = $members;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function getCourantMusical(): ?CourantMusical
    {
        return $this->courantMusical;
    }

    public function setCourantMusical(?CourantMusical $courantMusical): static
    {
        $this->courantMusical = $courantMusical;

        return $this;
    }

    public function setPresentation(?string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }
}
