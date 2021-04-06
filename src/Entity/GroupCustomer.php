<?php

namespace App\Entity;

use App\Repository\GroupCustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupCustomerRepository::class)
 */
class GroupCustomer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="groupCustomers")
     */
    private $groop;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="groupCustomers")
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroop(): ?Group
    {
        return $this->groop;
    }

    public function setGroop(?Group $groop): self
    {
        $this->groop = $groop;

        return $this;
    }

    public function getCustomer(): ?Klant
    {
        return $this->customer;
    }

    public function setCustomer(?Klant $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
