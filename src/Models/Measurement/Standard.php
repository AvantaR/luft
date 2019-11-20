<?php

namespace Luft\Models\Measurement;

class Standard
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|string
     */
    private $pollutant;

    /**
     * @var null|float
     */
    private $limit;

    /**
     * @var null|float
     */
    private $percent;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Standard
     */
    public function setName(?string $name): Standard
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPollutant(): ?string
    {
        return $this->pollutant;
    }

    /**
     * @param string|null $pollutant
     * @return Standard
     */
    public function setPollutant(?string $pollutant): Standard
    {
        $this->pollutant = $pollutant;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLimit(): ?float
    {
        return $this->limit;
    }

    /**
     * @param float|null $limit
     * @return Standard
     */
    public function setLimit(?float $limit): Standard
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercent(): ?float
    {
        return $this->percent;
    }

    /**
     * @param float|null $percent
     * @return Standard
     */
    public function setPercent(?float $percent): Standard
    {
        $this->percent = $percent;

        return $this;
    }
}