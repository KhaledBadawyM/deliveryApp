<?php

namespace App\Entity;

use App\Repository\ParcelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcelRepository::class)
 */
class Parcel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $pickUp;

    /**
     * @ORM\Column(type="text")
     */
    private $dropOff;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $pickedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deliveredAt;

    /**
     * @ORM\ManyToOne(targetEntity=Sender::class, inversedBy="parcels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity=Biker::class, inversedBy="parcels")
     */
    private $biker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPickUp(): ?string
    {
        return $this->pickUp;
    }

    public function setPickUp(string $pickUp): self
    {
        $this->pickUp = $pickUp;

        return $this;
    }

    public function getDropOff(): ?string
    {
        return $this->dropOff;
    }

    public function setDropOff(string $dropOff): self
    {
        $this->dropOff = $dropOff;

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

    public function getPickedAt(): ?\DateTimeInterface
    {
        return $this->pickedAt;
    }

    public function setPickedAt(?\DateTimeInterface $pickedAt): self
    {
        $this->pickedAt = $pickedAt;

        return $this;
    }

    public function getDeliveredAt(): ?\DateTimeInterface
    {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    public function getSender(): ?Sender
    {
        return $this->sender;
    }

    public function setSender(?Sender $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getBiker(): ?Biker
    {
        return $this->biker;
    }

    public function setBikerId(?Biker $biker): self
    {
        $this->biker = $biker;

        return $this;
    }
}
