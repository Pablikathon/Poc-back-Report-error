<?php

namespace App\Entity;

use App\Repository\LaunchRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LaunchRepository::class)]
class Launch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;
    public function __construct() {
        $this->Id=Uuid::v4();
    }
    public function getId(): ?string
    {
        return $this->Id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
