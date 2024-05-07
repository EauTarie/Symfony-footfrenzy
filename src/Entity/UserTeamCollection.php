<?php

namespace App\Entity;

use App\Repository\UserTeamCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTeamCollectionRepository::class)]
class UserTeamCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userTeamCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'userTeamCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $id_team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

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
