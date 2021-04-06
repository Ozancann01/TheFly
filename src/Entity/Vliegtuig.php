<?php

namespace App\Entity;

use App\Repository\VliegtuigRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VliegtuigRepository::class)
 */
class Vliegtuig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $bouwjaar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $benzineSoort;

    /**
     * @ORM\Column(type="integer")
     */
    private $Zitplaats;



    public function __construct()
    {
        $this->boekings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBouwjaar(): ?int
    {
        return $this->bouwjaar;
    }

    public function setBouwjaar(int $bouwjaar): self
    {
        $this->bouwjaar = $bouwjaar;

        return $this;
    }

    public function getBenzineSoort(): ?string
    {
        return $this->benzineSoort;
    }

    public function setBenzineSoort(string $benzineSoort): self
    {
        $this->benzineSoort = $benzineSoort;

        return $this;
    }

    public function getZitplaats(): ?int
    {
        return $this->Zitplaats;
    }

    public function setZitplaats(int $Zitplaats): self
    {
        $this->Zitplaats = $Zitplaats;

        return $this;
    }

}
