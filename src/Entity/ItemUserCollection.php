<?php

namespace App\Entity;

use App\Repository\ItemUserCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemUserCollectionRepository::class)]
class ItemUserCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itemUserCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'itemUserCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $id_item = null;

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

    public function getIdItem(): ?Shop
    {
        return $this->id_item;
    }

    public function setIdItem(?Shop $id_item): static
    {
        $this->id_item = $id_item;

        return $this;
    }
}
