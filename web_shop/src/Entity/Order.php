<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity=Phone::class, inversedBy="Quantity", orphanRemoval=true)
     * @ORM\JoinTable(name="order_phone")
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $GuestName;

    public function __construct()
    {
        $this->Phone = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Phone[]
     */
    public function getPhone(): Collection
    {
        return $this->Phone;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->Phone->contains($phone)) {
            $this->Phone[] = $phone;
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        $this->Phone->removeElement($phone);

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(string $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getGuestName(): ?string
    {
        return $this->GuestName;
    }

    public function setGuestName(string $GuestName): self
    {
        $this->GuestName = $GuestName;

        return $this;
    }
    public function __toString() { return $this->PhoneName; }
}
