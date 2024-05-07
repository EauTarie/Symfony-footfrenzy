<?php

namespace App\Entity;

use App\Repository\ItemTeamCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemTeamCollectionRepository::class)]
class ItemTeamCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itemTeamCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $id_item = null;

    #[ORM\ManyToOne(inversedBy: 'itemTeamCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $id_team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdItem(): ?Shop
    {
        return $this->id_item;
    }

    public function setIdItem(?Shop $id_item): static
    {
        $this->id_item = $id_item;

        return $this;
    }

    public function getIdTeam(): ?Team
    {
        return $this->id_team;
    }

    public function setIdTeam(?Team $id_team): static
    {
        $this->id_team = $id_team;

        return $this;
    }
}
