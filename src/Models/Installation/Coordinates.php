<?php

namespace Luft\Models\Installation;

class Coordinates
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float;
     */
    private $longitude;

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Coordinates
     */
    public function setLatitude(float $latitude): Coordinates
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Coordinates
     */
    public function setLongitude(float $longitude): Coordinates
    {
        $this->longitude = $longitude;

        return $this;
    }
}