<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Server')]
    private ?ConnexionMethod $connexionMethod = null;

    #[ORM\ManyToOne(inversedBy: 'server')]
    private ?Host $host = null;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOneToMany(): ?ConnexionMethod
    {
        return $this->connexionMethod;
    }

    public function setOneToMany(?ConnexionMethod $connexionMethod): static
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
