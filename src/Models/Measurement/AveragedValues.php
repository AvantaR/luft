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
     * @return AveragedValue
     */
    public function setFromDateTime(?string $fromDateTime): AveragedValue
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
     * @return AveragedValue
     */
    public function setTillDateTime(?string $tillDateTime): AveragedValue
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
     * @return AveragedValue
     */
    public function setValues(?array $values): AveragedValue
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
     * @return AveragedValue
     */
    public function setIndexes(?array $indexes): AveragedValue
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
     * @return AveragedValue
     */
    public function setStandards(?array $standards): AveragedValue
    {
        $this->standards = $standards;

        return $this;
    }
}