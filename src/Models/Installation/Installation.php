<?php

namespace Luft\Models\Installation;

class Installation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Coordinates
     */
    private $location;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var float
     */
    private $elevation;

    /**
     * @var boolean
     */
    private $airly;

    /**
     * @var Sponsor
     */
    private $sponsor;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Installation
     */
    public function setId(int $id): Installation
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getLocation(): Coordinates
    {
        return $this->location;
    }

    /**
     * @param Coordinates $location
     * @return Installation
     */
    public function setLocation(Coordinates $location): Installation
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Installation
     */
    public function setAddress(Address $address): Installation
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return float
     */
    public function getElevation(): float
    {
        return $this->elevation;
    }

    /**
     * @param float $elevation
     * @return Installation
     */
    public function setElevation(float $elevation): Installation
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAirly(): bool
    {
        return $this->airly;
    }

    /**
     * @param bool $airly
     * @return Installation
     */
    public function setAirly(bool $airly): Installation
    {
        $this->airly = $airly;

        return $this;
    }

    /**
     * @return Sponsor
     */
    public function getSponsor(): Sponsor
    {
        return $this->sponsor;
    }

    /**
     * @param Sponsor $sponsor
     * @return Installation
     */
    public function setSponsor(Sponsor $sponsor): Installation
    {
        $this->sponsor = $sponsor;

        return $this;
    }
}
