<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRepository::class)]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $path = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $howToUnlock = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_available = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $is_exclusive = null;

    /**
     * @var Collection<int, ItemTeamCollection>
     */
    #[ORM\OneToMany(targetEntity: ItemTeamCollection::class, mappedBy: 'id_item')]
    private Collection $itemTeamCollections;

    /**
     * @var Collection<int, ItemUserCollection>
     */
    #[ORM\OneToMany(targetEntity: ItemUserCollection::class, mappedBy: 'id_item')]
    private Collection $itemUserCollections;

    public function __construct()
    {
        $this->itemTeamCollections = new ArrayCollection();
        $this->itemUserCollections = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getHowToUnlock(): ?string
    {
        return $this->howToUnlock;
    }

    public function setHowToUnlock(?string $howToUnlock): static
    {
        $this->howToUnlock = $howToUnlock;

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

    public function isAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setAvailable(bool $is_available): static
    {
        $this->is_available = $is_available;

        return $this;
    }

    public function isExclusive(): ?bool
    {
        return $this->is_exclusive;
    }

    public function setExclusive(bool $is_exclusive): static
    {
        $this->is_exclusive = $is_exclusive;

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
            $itemTeamCollection->setIdItem($this);
        }

        return $this;
    }

    public function removeItemTeamCollection(ItemTeamCollection $itemTeamCollection): static
    {
        if ($this->itemTeamCollections->removeElement($itemTeamCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemTeamCollection->getIdItem() === $this) {
                $itemTeamCollection->setIdItem(null);
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
            $itemUserCollection->setIdItem($this);
        }

        return $this;
    }

    public function removeItemUserCollection(ItemUserCollection $itemUserCollection): static
    {
        if ($this->itemUserCollections->removeElement($itemUserCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemUserCollection->getIdItem() === $this) {
                $itemUserCollection->setIdItem(null);
            }
        }

        return $this;
    }
}
