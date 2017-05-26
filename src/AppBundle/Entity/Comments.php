<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\ManyToOne(targetEntity="Recipes", inversedBy="comments")
     * @ORM\JoinColumn(name="recipes_id", referencedColumnName="id")
     */
    protected $recipes;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     * @Assert\NotBlank(message="Pole nie może być puste!")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_add", type="datetime")
     */
    private $created_add;


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
     * Set comment
     *
     * @param string $comment
     *
     * @return Comments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAdd
     *
     * @param \DateTime $createdAdd
     *
     * @return Comments
     */
    public function setCreatedAdd($createdAdd)
    {
        $this->created_add = $createdAdd;

        return $this;
    }

    /**
     * Get createdAdd
     *
     * @return \DateTime
     */
    public function getCreatedAdd()
    {
        return $this->created_add;
    }

    /**
     * Set recipes
     *
     * @param \AppBundle\Entity\Recipes $recipes
     *
     * @return Comments
     */
    public function setRecipes(\AppBundle\Entity\Recipes $recipes = null)
    {
        $this->recipes = $recipes;

        return $this;
    }

    /**
     * Get recipes
     *
     * @return \AppBundle\Entity\Recipes
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
