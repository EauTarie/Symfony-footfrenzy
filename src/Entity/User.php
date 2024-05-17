<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?string $lastname = null;

    #[ORM\Column(length: 20)]
    private ?string $firstname = null;

    #[ORM\Column(length: 40)]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(length: 20)]
    private ?string $workingLocation = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $studyingClass = null;

    #[ORM\Column(length: 20, nullable: true, options: ["default" => "undefined"])]
    private ?string $favorite_role = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $pointsNumber = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastLogged_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $warned_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $banned_at = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_verified = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_warned = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_banned = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_password_reset_requested = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $passwordNumberRequest = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $warnNumber = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $totalPointsEarned = null;

    /**
     * @var Collection<int, Bet>
     */
    #[ORM\OneToMany(targetEntity: Bet::class, mappedBy: 'id_user')]
    private Collection $bets;

    /**
     * @var Collection<int, ItemUserCollection>
     */
    #[ORM\OneToMany(targetEntity: ItemUserCollection::class, mappedBy: 'id_user')]
    private Collection $itemUserCollections;

    /**
     * @var Collection<int, UserTeamCollection>
     */
    #[ORM\OneToMany(targetEntity: UserTeamCollection::class, mappedBy: 'id_user')]
    private Collection $userTeamCollections;

    #[ORM\Column]
    private bool $isVerified = false;

    public function __construct()
    {
        $this->bets = new ArrayCollection();
        $this->itemUserCollections = new ArrayCollection();
        $this->userTeamCollections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getWorkingLocation(): ?string
    {
        return $this->workingLocation;
    }

    public function setWorkingLocation(string $workingLocation): static
    {
        $this->workingLocation = $workingLocation;

        return $this;
    }

    public function getStudyingClass(): ?string
    {
        return $this->studyingClass;
    }

    public function setStudyingClass(?string $studyingClass): static
    {
        $this->studyingClass = $studyingClass;

        return $this;
    }

    public function getFavoriteRole(): ?string
    {
        return $this->favorite_role;
    }

    public function setFavoriteRole(?string $favorite_role): static
    {
        $this->favorite_role = $favorite_role;

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

    public function getLastLoggedAt(): ?\DateTimeInterface
    {
        return $this->lastLogged_at;
    }

    public function setLastLoggedAt(?\DateTimeInterface $lastLogged_at): static
    {
        $this->lastLogged_at = $lastLogged_at;

        return $this;
    }

    public function getWarnedAt(): ?\DateTimeInterface
    {
        return $this->warned_at;
    }

    public function setWarnedAt(?\DateTimeInterface $warned_at): static
    {
        $this->warned_at = $warned_at;

        return $this;
    }

    public function getBannedAt(): ?\DateTimeInterface
    {
        return $this->banned_at;
    }

    public function setBannedAt(?\DateTimeInterface $banned_at): static
    {
        $this->banned_at = $banned_at;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->is_verified;
    }

    public function setVerified(bool $is_verified): static
    {
        $this->is_verified = $is_verified;

        return $this;
    }

    public function isWarned(): ?bool
    {
        return $this->is_warned;
    }

    public function setWarned(bool $is_warned): static
    {
        $this->is_warned = $is_warned;

        return $this;
    }

    public function isBanned(): ?bool
    {
        return $this->is_banned;
    }

    public function setBanned(bool $is_banned): static
    {
        $this->is_banned = $is_banned;

        return $this;
    }

    public function isPasswordResetRequested(): ?bool
    {
        return $this->is_password_reset_requested;
    }

    public function setPasswordResetRequested(bool $is_password_reset_requested): static
    {
        $this->is_password_reset_requested = $is_password_reset_requested;

        return $this;
    }

    public function getPasswordNumberRequest(): ?int
    {
        return $this->passwordNumberRequest;
    }

    public function setPasswordNumberRequest(int $passwordNumberRequest): static
    {
        $this->passwordNumberRequest = $passwordNumberRequest;

        return $this;
    }

    public function getWarnNumber(): ?int
    {
        return $this->warnNumber;
    }

    public function setWarnNumber(int $warnNumber): static
    {
        $this->warnNumber = $warnNumber;

        return $this;
    }

    public function getTotalPointsEarned(): ?int
    {
        return $this->totalPointsEarned;
    }

    public function setTotalPointsEarned(int $totalPointsEarned): static
    {
        $this->totalPointsEarned = $totalPointsEarned;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Bet>
     */
    public function getBets(): Collection
    {
        return $this->bets;
    }

    public function addBet(Bet $bet): static
    {
        if (!$this->bets->contains($bet)) {
            $this->bets->add($bet);
            $bet->setIdUser($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): static
    {
        if ($this->bets->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getIdUser() === $this) {
                $bet->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemUserCollection>
     */
    public function getItemUserCollections(): Collection
    {
        return $this->itemUserCollections;
    }

    public function addItemUserCollection(ItemUserCollection $itemUserCollection): static
    {
        if (!$this->itemUserCollections->contains($itemUserCollection)) {
            $this->itemUserCollections->add($itemUserCollection);
            $itemUserCollection->setIdUser($this);
        }

        return $this;
    }

    public function removeItemUserCollection(ItemUserCollection $itemUserCollection): static
    {
        if ($this->itemUserCollections->removeElement($itemUserCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemUserCollection->getIdUser() === $this) {
                $itemUserCollection->setIdUser(null);
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
            $userTeamCollection->setIdUser($this);
        }

        return $this;
    }

    public function removeUserTeamCollection(UserTeamCollection $userTeamCollection): static
    {
        if ($this->userTeamCollections->removeElement($userTeamCollection)) {
            // set the owning side to null (unless already changed)
            if ($userTeamCollection->getIdUser() === $this) {
                $userTeamCollection->setIdUser(null);
            }
        }

        return $this;
    }
}
