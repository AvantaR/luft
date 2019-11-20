<?php

namespace Luft\Models\Measurement;

class Value
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Value
     */
    public function setName(?string $name): Value
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
     * @return Value
     */
    public function setValue(?float $value): Value
    {
        $this->value = $value;

        return $this;
    }

}