<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stichter;

    /**
     * @ORM\OneToMany(targetEntity=GroupCustomer::class, mappedBy="groop")
     */
    private $groupCustomers;

    public function __construct()
    {
        $this->groupCustomers = new ArrayCollection();
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

    public function getStichter(): ?KLant
    {
        return $this->stichter;
    }

    public function setStichter(?KLant $stichter): self
    {
        $this->stichter = $stichter;

        return $this;
    }

    /**
     * @return Collection|GroupCustomer[]
     */
    public function getGroupCustomers(): Collection
    {
        return $this->groupCustomers;
    }

    public function addGroupCustomer(GroupCustomer $groupCustomer): self
    {
        if (!$this->groupCustomers->contains($groupCustomer)) {
            $this->groupCustomers[] = $groupCustomer;
            $groupCustomer->setGroop($this);
        }

        return $this;
    }

    public function removeGroupCustomer(GroupCustomer $groupCustomer): self
    {
        if ($this->groupCustomers->removeElement($groupCustomer)) {
            // set the owning side to null (unless already changed)
            if ($groupCustomer->getGroop() === $this) {
                $groupCustomer->setGroop(null);
            }
        }

        return $this;
    }
}
