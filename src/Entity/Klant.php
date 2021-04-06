<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=KlantRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Klant implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adres;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $geslacht;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stad;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="klant")
     */
    private $bookings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unicCode;

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="stichter")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity=GroupCustomer::class, mappedBy="customer")
     */
    private $groupCustomers;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->groupCustomers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getGeslacht(): ?string
    {
        return $this->geslacht;
    }

    public function setGeslacht(string $geslacht): self
    {
        $this->geslacht = $geslacht;

        return $this;
    }
    public function getStad(): ?string
    {
        return $this->stad;
    }

    public function setStad(string $stad): self
    {
        $this->stad = $stad;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setKlant($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getKlant() === $this) {
                $booking->setKlant(null);
            }
        }

        return $this;
    }

    public function getUnicCode(): ?string
    {
        return $this->unicCode;
    }

    public function setUnicCode(string $unicCode): self
    {
        $this->unicCode = $unicCode;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->setStichter($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getStichter() === $this) {
                $group->setStichter(null);
            }
        }

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
            $groupCustomer->setCustomer($this);
        }

        return $this;
    }

    public function removeGroupCustomer(GroupCustomer $groupCustomer): self
    {
        if ($this->groupCustomers->removeElement($groupCustomer)) {
            // set the owning side to null (unless already changed)
            if ($groupCustomer->getCustomer() === $this) {
                $groupCustomer->setCustomer(null);
            }
        }

        return $this;
    }

}
