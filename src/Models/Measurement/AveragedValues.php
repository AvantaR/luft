<?php

namespace Luft\Models\Measurement;

class AveragedValues
{
    /**
     * @var null|string
     */
    private $fromDateTime;

    /**
     * @var null|string
     */
    private $tillDateTime;

    /**
     * @var null|Value[]
     */
    private $values;

    /**
     * @var null|Index[]
     */
    private $indexes;

    /**
     * @var null|Standard[]
     */
    private $standards;

    /**
     * @return string|null
     */
    public function getFromDateTime(): ?string
    {
        return $this->fromDateTime;
    }

    /**
     * @param string|null $fromDateTime
     * @return AveragedValues
     */
    public function setFromDateTime(?string $fromDateTime): AveragedValues
    {
        $this->fromDateTime = $fromDateTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTillDateTime(): ?string
    {
        return $this->tillDateTime;
    }

    /**
     * @param string|null $tillDateTime
     * @return AveragedValues
     */
    public function setTillDateTime(?string $tillDateTime): AveragedValues
    {
        $this->tillDateTime = $tillDateTime;

        return $this;
    }

    /**
     * @return Value[]|null
     */
    public function getValues(): ?array
    {
        return $this->values;
    }

    /**
     * @param Value[]|null $values
     * @return AveragedValues
     */
    public function setValues(?array $values): AveragedValues
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return Index[]|null
     */
    public function getIndexes(): ?array
    {
        return $this->indexes;
    }

    /**
     * @param Index[]|null $indexes
     * @return AveragedValues
     */
    public function setIndexes(?array $indexes): AveragedValues
    {
        $this->indexes = $indexes;

        return $this;
    }

    /**
     * @return Standard[]|null
     */
    public function getStandards(): ?array
    {
        return $this->standards;
    }

    /**
     * @param Standard[]|null $standards
     * @return AveragedValues
     */
    public function setStandards(?array $standards): AveragedValues
    {
        $this->standards = $standards;

        return $this;
    }
}
