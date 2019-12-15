<?php

namespace App\Entity;

/**
 * Description of Recipes
 *
 * @author reachusolutions
 */
class IngredientsResponse
{
    /**
     *  @var array
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = array();
    }

    /**
     *  @return Collection|Ingredient[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients)
    {
        $new_ingredients = array();
        if (!empty($ingredients)) {
            foreach ($ingredients as $ingredient) {
                $new_ingredient = new Ingredient();
                $new_ingredient->setTitle($ingredient['title']);
                $new_ingredient->setBestBefore($ingredient['best-before']);
                $new_ingredient->setUseBy($ingredient['use-by']);
                $new_ingredients[] = $new_ingredient;
            }
        }
        $this->ingredients = $new_ingredients;
    }
}
