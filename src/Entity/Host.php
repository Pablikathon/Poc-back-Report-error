<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: HostRepository::class)]
class Host
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 16, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private $Id = null;

    #[ORM\Column(length: 255)]
    private string $libelle;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: Server::class)]
    private Collection $server;



    public function __construct(string $libelle)
    {
        $this->libelle = $libelle;
        $this->server = new ArrayCollection();
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

    /**
     * @return Collection<int, server>
     */
    public function getServer(): Collection
    {
        return $this->server;
    }

    public function addServer(server $server): static
    {
        if (!$this->server->contains($server)) {
            $this->server->add($server);
        }

        return $this;
    }

    public function removeServer(server $server): static
    {
        $this->server->removeElement($server);

        return $this;
    }
}
