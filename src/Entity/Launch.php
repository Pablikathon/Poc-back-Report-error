<?php

namespace App\Entity;

use App\Repository\LaunchRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LaunchRepository::class)]
class Launch
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 16, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;
    public function __construct() {
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
