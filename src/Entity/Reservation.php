<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $sexe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $reservedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $leaveAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Bed::class, inversedBy="reservations")
     */
    private $bed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getReservedAt(): ?\DateTimeInterface
    {
        return $this->reservedAt;
    }

    public function setReservedAt(\DateTimeInterface $reservedAt): self
    {
        $this->reservedAt = $reservedAt;

        return $this;
    }

    public function getLeaveAt(): ?\DateTimeInterface
    {
        return $this->leaveAt;
    }

    public function setLeaveAt(?\DateTimeInterface $leaveAt): self
    {
        $this->leaveAt = $leaveAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBed(): ?Bed
    {
        return $this->bed;
    }

    public function setBed(?Bed $bed): self
    {
        $this->bed = $bed;

        return $this;
    }
}
