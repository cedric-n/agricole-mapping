<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lon;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $insee_code;

    /**
     * @ORM\OneToMany(targetEntity=Buyer::class, mappedBy="city")
     */
    private $buyers;

    /**
     * @ORM\OneToMany(targetEntity=Farmer::class, mappedBy="city")
     */
    private $farmers;

    public function __construct()
    {
        $this->buyers = new ArrayCollection();
        $this->farmers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getInseeCode(): ?string
    {
        return $this->insee_code;
    }

    public function setInseeCode(string $insee_code): self
    {
        $this->insee_code = $insee_code;

        return $this;
    }

    /**
     * @return Collection|Buyer[]
     */
    public function getBuyers(): Collection
    {
        return $this->buyers;
    }

    public function addBuyer(Buyer $buyer): self
    {
        if (!$this->buyers->contains($buyer)) {
            $this->buyers[] = $buyer;
            $buyer->setCity($this);
        }

        return $this;
    }

    public function removeBuyer(Buyer $buyer): self
    {
        if ($this->buyers->removeElement($buyer)) {
            // set the owning side to null (unless already changed)
            if ($buyer->getCity() === $this) {
                $buyer->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Farmer[]
     */
    public function getFarmers(): Collection
    {
        return $this->farmers;
    }

    public function addFarmer(Farmer $farmer): self
    {
        if (!$this->farmers->contains($farmer)) {
            $this->farmers[] = $farmer;
            $farmer->setCity($this);
        }

        return $this;
    }

    public function removeFarmer(Farmer $farmer): self
    {
        if ($this->farmers->removeElement($farmer)) {
            // set the owning side to null (unless already changed)
            if ($farmer->getCity() === $this) {
                $farmer->setCity(null);
            }
        }

        return $this;
    }
}
