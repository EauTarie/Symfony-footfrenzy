<?php

namespace App\Entity;

use App\Repository\BetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BetRepository::class)]
class Bet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'bets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $id_game = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pointsBetted = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $id_team = null;

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

    public function getIdGame(): ?Game
    {
        return $this->id_game;
    }

    public function setIdGame(?Game $id_game): static
    {
        $this->id_game = $id_game;

        return $this;
    }

    public function getPointsBetted(): ?int
    {
        return $this->pointsBetted;
    }

    public function setPointsBetted(int $pointsBetted): static
    {
        $this->pointsBetted = $pointsBetted;

        return $this;
    }

    public function getIdTeam(): ?int
    {
        return $this->id_team;
    }

    public function setIdTeam(int $id_team): static
    {
        $this->id_team = $id_team;

        return $this;
    }
}
