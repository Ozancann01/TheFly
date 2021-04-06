<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $DatumBooking;

    /**
     * @ORM\Column(type="date")
     */
    private $DatumVlucht;


    /**
     * @ORM\ManyToOne(targetEntity=Vliegtuig::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vliegtuigID;

    /**
     * @ORM\ManyToOne(targetEntity=Vliegveld::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vertrekVliegveldId;

    /**
     * @ORM\ManyToOne(targetEntity=Vliegveld::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $eindVliegveldId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stoel;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="bookings")
     */
    private $klant;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumBooking(): ?\DateTimeInterface
    {
        return $this->DatumBooking;
    }

    public function setDatumBooking(\DateTimeInterface $DatumBooking): self
    {
        $this->DatumBooking = $DatumBooking;

        return $this;
    }

    public function getDatumVlucht(): ?\DateTimeInterface
    {
        return $this->DatumVlucht;
    }

    public function setDatumVlucht(\DateTimeInterface $DatumVlucht): self
    {
        $this->DatumVlucht = $DatumVlucht;

        return $this;
    }


    public function getVliegtuigID(): ?Vliegtuig
    {
        return $this->vliegtuigID;
    }

    public function setVliegtuigID(?Vliegtuig $vliegtuigID): self
    {
        $this->vliegtuigID = $vliegtuigID;

        return $this;
    }

    public function getVertrekVliegveldId(): ?Vliegveld
    {
        return $this->vertrekVliegveldId;
    }

    public function setVertrekVliegveldId(?Vliegveld $vertrekVliegveldId): self
    {
        $this->vertrekVliegveldId = $vertrekVliegveldId;

        return $this;
    }

    public function getEindVliegveldId(): ?Vliegveld
    {
        return $this->eindVliegveldId;
    }

    public function setEindVliegveldId(?Vliegveld $eindVliegveldId): self
    {
        $this->eindVliegveldId = $eindVliegveldId;

        return $this;
    }

    public function getStoel(): ?string
    {
        return $this->stoel;
    }

    public function setStoel(string $stoel): self
    {
        $this->stoel = $stoel;

        return $this;
    }

    public function getKlant(): ?Klant
    {
        return $this->klant;
    }

    public function setKlant(?Klant $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getAantalPersonen(): ?int
    {
        return $this->aantalPersonen;
    }

    public function setAantalPersonen(?int $aantalPersonen): self
    {
        $this->aantalPersonen = $aantalPersonen;

        return $this;
    }
}
