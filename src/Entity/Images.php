<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Images
 *
 * @ORM\Table(name="images", indexes={@ORM\Index(name="article_id", columns={"article_id"})})
 * @ORM\Entity
 */
class Images
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
     * @ORM\Column(name="content", type="blob", length=16777215, nullable=false)
     */
    private $content;

    // /**
    //  * @var \Articles
    //  *
    //  * @ORM\ManyToOne(targetEntity="Articles")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
    //  * })
    //  */

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Articles", inversedBy="images")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }


}
