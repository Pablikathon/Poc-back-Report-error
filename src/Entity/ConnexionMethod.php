<?php

namespace App\Entity;

use App\Repository\ConnexionMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ConnexionMethodRepository::class)]
class ConnexionMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'OneToMany', targetEntity: server::class)]
    private Collection $Server;


    public function __construct()
    {
        $this->Id=Uuid::v4();
        $this->Server = new ArrayCollection();
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
        return $this->Server;
    }

    public function addServer(server $server): static
    {
        if (!$this->Server->contains($server)) {
            $this->Server->add($server);
            $server->setOneToMany($this);
        }

        return $this;
    }

    public function removeServer(server $server): static
    {
        if ($this->Server->removeElement($server)) {
            // set the owning side to null (unless already changed)
            if ($server->getOneToMany() === $this) {
                $server->setOneToMany(null);
            }
        }

        return $this;
    }


}
