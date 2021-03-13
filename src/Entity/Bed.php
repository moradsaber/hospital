<?php

namespace App\Entity;

use App\Repository\BedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BedRepository::class)
 */
class Bed
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
    private $postion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOperationel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="beds")
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="bed")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostion(): ?string
    {
        return $this->postion;
    }

    public function setPostion(string $postion): self
    {
        $this->postion = $postion;

        return $this;
    }

    public function getIsOperationel(): ?bool
    {
        return $this->isOperationel;
    }

    public function setIsOperationel(bool $isOperationel): self
    {
        $this->isOperationel = $isOperationel;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setBed($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getBed() === $this) {
                $reservation->setBed(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getRoom()->getLabel() .'-'. $this->getPostion() . '-' . $this->getId();
    }
}
