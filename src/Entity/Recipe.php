<?php

namespace App\Entity;

/**
 * Description of Recipe
 *
 * @author reachusolutions
 */
class Recipe
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var array
     */
    private $ingredients;

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Collection|String[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }
}
