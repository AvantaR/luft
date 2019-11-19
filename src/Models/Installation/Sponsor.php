<?php

namespace Luft\Models\Installation;

class Sponsor
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string
     */
    private $description;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var null|string
     */
    private $link;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Sponsor
     */
    public function setId(int $id): Sponsor
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Sponsor
     */
    public function setName(string $name): Sponsor
    {
        $this->name = $name;

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
     * @return Sponsor
     */
    public function setDescription(?string $description): Sponsor
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Sponsor
     */
    public function setLogo(string $logo): Sponsor
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return Sponsor
     */
    public function setLink(?string $link): Sponsor
    {
        $this->link = $link;

        return $this;
    }
}
