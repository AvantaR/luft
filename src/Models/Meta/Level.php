<?php

namespace Luft\Models\Meta;

class Level
{
    /**
     * @var ?float
     */
    private $minValue;

    /**
     * @var ?float
     */
    private $maxValue;

    /**
     * @var string
     */
    private $values;

    /**
     * @var string
     */
    private $level;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $color;

    /**
     * @return null|int
     */
    public function getMinValue(): ?int
    {
        return $this->minValue;
    }

    /**
     * @param null|int $minValue
     * @return Level
     */
    public function setMinValue(?int $minValue): Level
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getMaxValue(): ?int
    {
        return $this->maxValue;
    }

    /**
     * @param null|int $maxValue
     * @return Level
     */
    public function setMaxValue(?int $maxValue): Level
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getValues(): string
    {
        return $this->values;
    }

    /**
     * @param string $values
     * @return Level
     */
    public function setValues(string $values): Level
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     * @return Level
     */
    public function setLevel(string $level): Level
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Level
     */
    public function setDescription(string $description): Level
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Level
     */
    public function setColor(string $color): Level
    {
        $this->color = $color;

        return $this;
    }


}

