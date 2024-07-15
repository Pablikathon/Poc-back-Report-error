<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 16, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Server')]
    private ?ConnexionMethod $connexionMethod = null;

    #[ORM\ManyToOne(inversedBy: 'server')]
    private ?Host $host = null;



    public function __construct()
    {
    }

    public function getId(): ?string
    {
        return $this->Id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getConnexionMethod(): ?ConnexionMethod
    {
        return $this->connexionMethod;
    }

    public function setConnexionMethod(?ConnexionMethod $connexionMethod): static
    {
        $this->connexionMethod = $connexionMethod;

        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): static
    {
        $this->host = $host;

        return $this;
    }
}
