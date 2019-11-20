<?php

namespace Luft\Models\Measurement;

class Index
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|float
     */
    private $value;

    /**
     * @var null|string
     */
    private $level;

    /**
     * @var null|string
     */
    private $description;

    /**
     * @var null|string
     */
    private $advice;

    /**
     * @var null|string
     */
    private $color;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Index
     */
    public function setName(?string $name): Index
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float|null $value
     * @return Index
     */
    public function setValue(?float $value): Index
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @param string|null $level
     * @return Index
     */
    public function setLevel(?string $level): Index
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Index
     */
    public function setDescription(?string $description): Index
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdvice(): ?string
    {
        return $this->advice;
    }

    /**
     * @param string|null $advice
     * @return Index
     */
    public function setAdvice(?string $advice): Index
    {
        $this->advice = $advice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return Index
     */
    public function setColor(?string $color): Index
    {
        $this->color = $color;

        return $this;
    }
}