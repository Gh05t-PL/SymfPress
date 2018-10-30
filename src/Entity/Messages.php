<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity
 */
class Messages
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
     * @var int|null
     *
     * @ORM\Column(name="from_user", type="integer", nullable=true)
     */
    private $fromUser;

    /**
     * @var int
     *
     * @ORM\Column(name="to_user", type="integer", nullable=false)
     */
    private $toUser;

    /**
     * @var int
     *
     * @ORM\Column(name="topic", type="integer", nullable=false)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=21, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=500, nullable=false)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromUser(): ?int
    {
        return $this->fromUser;
    }

    public function setFromUser(?int $fromUser): self
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    public function getToUser(): ?int
    {
        return $this->toUser;
    }

    public function setToUser(int $toUser): self
    {
        $this->toUser = $toUser;

        return $this;
    }

    public function getTopic(): ?int
    {
        return $this->topic;
    }

    public function setTopic(int $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }


}
