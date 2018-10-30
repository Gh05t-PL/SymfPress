<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="author_id", columns={"author_id"})})
 * @ORM\Entity
 */
class Articles
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
     * @var bool
     *
     * @ORM\Column(name="selected", type="boolean", nullable=false)
     */
    private $selected = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="created_date", type="integer", nullable=false)
     */
    private $createdDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="edited_date", type="integer", nullable=true)
     */
    private $editedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=5000, nullable=false)
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="visits", type="integer", nullable=false)
     */
    private $visits = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     */
    private $likes = '0';

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * One Article can have Many Images.
     * @ORM\OneToMany(targetEntity="Images", mappedBy="article")
     */
    private $images;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @param bool $selected
     */
    public function setSelected(bool $selected): void
    {
        $this->selected = $selected;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getCreatedDate(): int
    {
        return $this->createdDate;
    }

    /**
     * @param int $createdDate
     */
    public function setCreatedDate(int $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return int|null
     */
    public function getEditedDate(): ?int
    {
        return $this->editedDate;
    }

    /**
     * @param int|null $editedDate
     */
    public function setEditedDate(?int $editedDate): void
    {
        $this->editedDate = $editedDate;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getVisits(): int
    {
        return $this->visits;
    }

    /**
     * @param int $visits
     */
    public function setVisits(int $visits): void
    {
        $this->visits = $visits;
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return \Categories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Categories $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return \Users
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \Int $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }




}
