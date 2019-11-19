<?php

namespace Luft\Models\Installation;

class Address
{
    /**
     * @var null|string
     */
    private $country;

    /**
     * @var null|string
     */
    private $city;

    /**
     * @var null|string
     */
    private $street;

    /**
     * @var null|string
     */
    private $number;

    /**
     * @var null|string
     */
    private $displayAddress1;

    /**
     * @var null|string
     */
    private $displayAddress2;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return Address
     */
    public function setCountry(?string $country): Address
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     * @return Address
     */
    public function setNumber(?string $number): Address
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisplayAddress1(): ?string
    {
        return $this->displayAddress1;
    }

    /**
     * @param string|null $displayAddress1
     * @return Address
     */
    public function setDisplayAddress1(?string $displayAddress1): Address
    {
        $this->displayAddress1 = $displayAddress1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisplayAddress2(): ?string
    {
        return $this->displayAddress2;
    }

    /**
     * @param string|null $displayAddress2
     * @return Address
     */
    public function setDisplayAddress2(?string $displayAddress2): Address
    {
        $this->displayAddress2 = $displayAddress2;

        return $this;
    }
}
