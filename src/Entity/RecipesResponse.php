<?php

namespace App\Entity;

/**
 * Description of Recipes
 *
 * @author reachusolutions
 */
class RecipesResponse
{
    /**
     * @var array
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = array();
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    public function setRecipes($recipes)
    {
        $new_recipes = array();
        if (!empty($recipes)) {
            foreach ($recipes as $recipe) {
                $new_recipe = new Recipe();
                $new_recipe->setTitle($recipe['title']);
                $new_recipe->setIngredients($recipe['ingredients']);
                $new_recipes[] = $new_recipe;
            }
        }
        $this->recipes = $new_recipes;
    }
}
