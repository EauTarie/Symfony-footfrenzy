<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $name = null;

    #[ORM\Column(length: 75, nullable: true)]
    private ?string $slogan = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $pointsNumber = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(options: ["default" => 1])]
    private ?bool $is_recruting = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_dissolute = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $totalPointEarned = null;

    /**
     * @var Collection<int, ItemTeamCollection>
     */
    #[ORM\OneToMany(targetEntity: ItemTeamCollection::class, mappedBy: 'id_team')]
    private Collection $itemTeamCollections;

    /**
     * @var Collection<int, UserTeamCollection>
     */
    #[ORM\OneToMany(targetEntity: UserTeamCollection::class, mappedBy: 'id_team')]
    private Collection $userTeamCollections;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'id_blueTeam')]
    private Collection $games;

    public function __construct()
    {
        $this->itemTeamCollections = new ArrayCollection();
        $this->userTeamCollections = new ArrayCollection();
        $this->games = new ArrayCollection();
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

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): static
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPointsNumber(): ?int
    {
        return $this->pointsNumber;
    }

    public function setPointsNumber(int $pointsNumber): static
    {
        $this->pointsNumber = $pointsNumber;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isRecruting(): ?bool
    {
        return $this->is_recruting;
    }

    public function setRecruting(bool $is_recruting): static
    {
        $this->is_recruting = $is_recruting;

        return $this;
    }

    public function isDissolute(): ?bool
    {
        return $this->is_dissolute;
    }

    public function setDissolute(bool $is_dissolute): static
    {
        $this->is_dissolute = $is_dissolute;

        return $this;
    }

    public function getTotalPointEarned(): ?int
    {
        return $this->totalPointEarned;
    }

    public function setTotalPointEarned(int $totalPointEarned): static
    {
        $this->totalPointEarned = $totalPointEarned;

        return $this;
    }

    /**
     * @return Collection<int, ItemTeamCollection>
     */
    public function getItemTeamCollections(): Collection
    {
        return $this->itemTeamCollections;
    }

    public function addItemTeamCollection(ItemTeamCollection $itemTeamCollection): static
    {
        if (!$this->itemTeamCollections->contains($itemTeamCollection)) {
            $this->itemTeamCollections->add($itemTeamCollection);
            $itemTeamCollection->setIdTeam($this);
        }

        return $this;
    }

    public function removeItemTeamCollection(ItemTeamCollection $itemTeamCollection): static
    {
        if ($this->itemTeamCollections->removeElement($itemTeamCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemTeamCollection->getIdTeam() === $this) {
                $itemTeamCollection->setIdTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserTeamCollection>
     */
    public function getUserTeamCollections(): Collection
    {
        return $this->userTeamCollections;
    }

    public function addUserTeamCollection(UserTeamCollection $userTeamCollection): static
    {
        if (!$this->userTeamCollections->contains($userTeamCollection)) {
            $this->userTeamCollections->add($userTeamCollection);
            $userTeamCollection->setIdTeam($this);
        }

        return $this;
    }

    public function removeUserTeamCollection(UserTeamCollection $userTeamCollection): static
    {
        if ($this->userTeamCollections->removeElement($userTeamCollection)) {
            // set the owning side to null (unless already changed)
            if ($userTeamCollection->getIdTeam() === $this) {
                $userTeamCollection->setIdTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setIdBlueTeam($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getIdBlueTeam() === $this) {
                $game->setIdBlueTeam(null);
            }
        }

        return $this;
    }
}
