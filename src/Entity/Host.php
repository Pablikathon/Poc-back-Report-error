<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HostRepository::class)]
class Host
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $Id = null;

    #[ORM\Column(length: 255)]
    private string $libelle;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: server::class)]
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
