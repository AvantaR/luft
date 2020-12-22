<?php

namespace Luft\Models\Measurement;

class Measurement
{
    /**
     * @var null|AveragedValues
     */
    private $current;

    /**
     * @var null|AveragedValues[]
     */
    private $history;

    /**
     * @var null|AveragedValues[]
     */
    private $forecast;

    /**
     * @return AveragedValues|null
     */
    public function getCurrent(): ?AveragedValues
    {
        return $this->current;
    }

    /**
     * @param AveragedValues|null $current
     * @return Measurement
     */
    public function setCurrent(?AveragedValues $current): Measurement
    {
        $this->current = $current;

        return $this;
    }

    /**
     * @return AveragedValues[]|null
     */
    public function getHistory(): ?array
    {
        return $this->history;
    }

    /**
     * @param AveragedValues[]|null $history
     * @return Measurement
     */
    public function setHistory(?array $history): Measurement
    {
        $this->history = $history;

        return $this;
    }

    /**
     * @return AveragedValues[]|null
     */
    public function getForecast(): ?array
    {
        return $this->forecast;
    }

    /**
     * @param AveragedValues[]|null $forecast
     * @return Measurement
     */
    public function setForecast(?array $forecast): Measurement
    {
        $this->forecast = $forecast;

        return $this;
    }
}
