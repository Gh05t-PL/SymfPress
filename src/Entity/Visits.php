<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visits
 *
 * @ORM\Table(name="visits", uniqueConstraints={@ORM\UniqueConstraint(name="identifier_uq", columns={"identifier"})})
 * @ORM\Entity
 */
class Visits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=16, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=40, nullable=false)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=500, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }


}
