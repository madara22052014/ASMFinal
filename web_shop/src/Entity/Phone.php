<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $PhoneName;

    /**
     * @ORM\ManyToOne(targetEntity=Publisher::class, inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Publisher;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $OperatingSystem;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Memory;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $RAM;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Dimension;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;


    public function __construct()
    {
        $this->Quantity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneName(): ?string
    {
        return $this->PhoneName;
    }

    public function setPhoneName(string $PhoneName): self
    {
        $this->PhoneName = $PhoneName;

        return $this;
    }

    public function getPublisher(): ?Publisher
    {
        return $this->Publisher;
    }

    public function setPublisher(?Publisher $Publisher): self
    {
        $this->Publisher = $Publisher;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->OperatingSystem;
    }

    public function setOperatingSystem(string $OperatingSystem): self
    {
        $this->OperatingSystem = $OperatingSystem;

        return $this;
    }

    public function getMemory(): ?string
    {
        return $this->Memory;
    }

    public function setMemory(string $Memory): self
    {
        $this->Memory = $Memory;

        return $this;
    }

    public function getRAM(): ?string
    {
        return $this->RAM;
    }

    public function setRAM(string $RAM): self
    {
        $this->RAM = $RAM;

        return $this;
    }

    public function getDimension(): ?string
    {
        return $this->Dimension;
    }

    public function setDimension(string $Dimension): self
    {
        $this->Dimension = $Dimension;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getGuestName(): Collection
    {
        return $this->GuestName;
    }

    public function addGuestName(Order $guestname): self
    {
        if (!$this->GuestName->contains($guestname)) {
            $this->GuestName[] = $guestname;
            $guestname->addPhone($this);
        }

        return $this;
    }

    public function removeGuestName(Order $guestname): self
    {
        if ($this->GuestName->removeElement($guestname)) {
            $guestname->removePhone($this);
        }

        return $this;
    }
    public function __toString() {
        return $this->PhoneName;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image)
    {
        $this->Image = $Image;

        return $this;
    }
}
