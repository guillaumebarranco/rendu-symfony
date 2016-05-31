<?php

namespace AppBundle\Entity;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @ORM\Table 
 */
class Articles {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     */
    protected $keywords;

    /**
     * @ORM\Column(type="string")
     */
    protected $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /*
    *   GETTERS
    */

        public function getId() {
            return $this->id;
        }
        public function getTitle() {
            return $this->title;
        }
        public function getAuthor() {
            return $this->author;
        }
        public function getCategory() {
            return $this->category;
        }
        public function getContent() {
            return $this->content;
        }
        public function getSlug() {
            return $this->slug;
        }
        public function getKeywords() {
            return $this->keywords;
        }

    /*
    *   SETTERS
    */

        public function setId($id) {
            $this->id = $id;
        }
        public function setTitle($title) {
            $this->title = $title;
        }
        public function setAuthor($author) {
            $this->author = $author;
        }
        public function setCategory($category) {
            $this->category = $category;
        }
        public function setContent($content) {
            $this->content = $content;
        }
        public function setSlug($slug) {
            $slug = str_replace(' ', '_', $slug);
            $slug = strtolower($slug);
            $slug = substr($slug, 0, 30);

            $this->slug = $slug;
        }

        public function setKeywords($keywords) {
            $this->keywords = $keywords;
        }

        public function setCreatedAt() {
            $this->created_at = new \Datetime();
        }
        public function setUpdatedAt() {
            $this->updated_at = new \Datetime();
        }
        public function getPicture() {
            return $this->picture;
        }
        public function setPicture($picture) {
            $this->picture = $picture;
        }


    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Articles
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
