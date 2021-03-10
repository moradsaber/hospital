<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomType;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="rooms")
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity=Bed::class, mappedBy="room")
     */
    private $beds;

    public function __construct()
    {
        $this->beds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->roomType;
    }

    public function setRoomType(string $roomType): self
    {
        $this->roomType = $roomType;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection|Bed[]
     */
    public function getBeds(): Collection
    {
        return $this->beds;
    }

    public function addBed(Bed $bed): self
    {
        if (!$this->beds->contains($bed)) {
            $this->beds[] = $bed;
            $bed->setRoom($this);
        }

        return $this;
    }

    public function removeBed(Bed $bed): self
    {
        if ($this->beds->removeElement($bed)) {
            // set the owning side to null (unless already changed)
            if ($bed->getRoom() === $this) {
                $bed->setRoom(null);
            }
        }

        return $this;
    }
}
