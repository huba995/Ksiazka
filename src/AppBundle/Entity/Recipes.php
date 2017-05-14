<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Recipes
 *
 * @ORM\Table(name="recipes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipesRepository")
 */
class Recipes
{
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
     * @ORM\Column(name="name_recipe", type="string", length=255)
     */
    private $name_recipe;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_add", type="datetime")
     */
    private $created_add;

    /**
     * @var bool
     *
     * @ORM\Column(name="mydisplay", type="boolean")
     */
    private $mydisplay;

    /**
     * @var int
     *
     * @ORM\Column(name="plus", type="integer")
     */
    private $plus;

    /**
     * @var int
     *
     * @ORM\Column(name="minus", type="integer")
     */
    private $minus;


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
     * Set nameRecipe
     *
     * @param string $nameRecipe
     *
     * @return Recipes
     */
    public function setNameRecipe($nameRecipe)
    {
        $this->name_recipe = $nameRecipe;

        return $this;
    }

    /**
     * Get nameRecipe
     *
     * @return string
     */
    public function getNameRecipe()
    {
        return $this->name_recipe;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Recipes
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
     * Set createdAdd
     *
     * @param \DateTime $createdAdd
     *
     * @return Recipes
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
     * Set mydisplay
     *
     * @param boolean $mydisplay
     *
     * @return Recipes
     */
    public function setMydisplay($mydisplay)
    {
        $this->mydisplay = $mydisplay;

        return $this;
    }

    /**
     * Get mydisplay
     *
     * @return bool
     */
    public function getMydisplay()
    {
        return $this->mydisplay;
    }

    /**
     * Set plus
     *
     * @param integer $plus
     *
     * @return Recipes
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return int
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * Set minus
     *
     * @param integer $minus
     *
     * @return Recipes
     */
    public function setMinus($minus)
    {
        $this->minus = $minus;

        return $this;
    }

    /**
     * Get minus
     *
     * @return int
     */
    public function getMinus()
    {
        return $this->minus;
    }

    /**
     * @ORM\OneToMany(targetEntity="Ingredients", mappedBy="recipes")
     */
    protected $ingredients;


    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    /**
     * Add ingredient
     *
     * @param \AppBundle\Entity\Ingredients $ingredient
     *
     * @return Recipes
     */
    public function addIngredient(\AppBundle\Entity\Ingredients $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \AppBundle\Entity\Ingredients $ingredient
     */
    public function removeIngredient(\AppBundle\Entity\Ingredients $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }


}
