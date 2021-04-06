<?php

namespace App\Entity;

use App\Repository\LandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LandRepository::class)
 */
class Land
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
    private $naam;

    /**
     * @ORM\OneToMany(targetEntity=Stad::class, mappedBy="land")
     */
    private $stads;

    /**
     * @ORM\OneToMany(targetEntity=Vliegveld::class, mappedBy="land")
     */
    private $vliegvelds;

    public function __construct()
    {
        $this->stads = new ArrayCollection();
        $this->vliegvelds = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * @return Collection|Stad[]
     */
    public function getStads(): Collection
    {
        return $this->stads;
    }

    public function addStad(Stad $stad): self
    {
        if (!$this->stads->contains($stad)) {
            $this->stads[] = $stad;
            $stad->setLand($this);
        }

        return $this;
    }

    public function removeStad(Stad $stad): self
    {
        if ($this->stads->removeElement($stad)) {
            // set the owning side to null (unless already changed)
            if ($stad->getLand() === $this) {
                $stad->setLand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vliegveld[]
     */
    public function getVliegvelds(): Collection
    {
        return $this->vliegvelds;
    }

    public function addVliegveld(Vliegveld $vliegveld): self
    {
        if (!$this->vliegvelds->contains($vliegveld)) {
            $this->vliegvelds[] = $vliegveld;
            $vliegveld->setLand($this);
        }

        return $this;
    }

    public function removeVliegveld(Vliegveld $vliegveld): self
    {
        if ($this->vliegvelds->removeElement($vliegveld)) {
            // set the owning side to null (unless already changed)
            if ($vliegveld->getLand() === $this) {
                $vliegveld->setLand(null);
            }
        }

        return $this;
    }

}
