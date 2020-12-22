<?php

namespace Luft\Models\Meta;

class Type
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Level[]
     */
    private $levels;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Type
     */
    public function setName(string $name): Type
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Level[]
     */
    public function getLevels(): array
    {
        return $this->levels;
    }

    /**
     * @param Level[] $levels
     * @return Type
     */
    public function setLevels(array $levels): Type
    {
        $this->levels = $levels;

        return $this;
    }
}
