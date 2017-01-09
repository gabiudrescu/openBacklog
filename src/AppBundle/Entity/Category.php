<?php

namespace AppBundle\Entity;

/**
 * Category
 */
class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @var string
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ideas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ideas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add idea
     *
     * @param \AppBundle\Entity\Idea $idea
     *
     * @return Category
     */
    public function addIdea(\AppBundle\Entity\Idea $idea)
    {
        $this->ideas[] = $idea;

        return $this;
    }

    /**
     * Remove idea
     *
     * @param \AppBundle\Entity\Idea $idea
     */
    public function removeIdea(\AppBundle\Entity\Idea $idea)
    {
        $this->ideas->removeElement($idea);
    }

    /**
     * Get ideas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdeas()
    {
        return $this->ideas;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
