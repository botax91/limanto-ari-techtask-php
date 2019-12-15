<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\RecipesResponse;
use App\Entity\IngredientsResponse;

class LunchController extends Controller
{
    
    /**
     * @Route("/lunch")
     */
    public function lunch()
    {
        // declare serializer
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $current_date = date('Y-m-d');
        $recommendations = $high_quality_ingredient = $low_quality_ingredient = array();

        $ingredient_in_fridge = $serializer->deserialize(file_get_contents($this->get('kernel')->getProjectDir()
                        . '/assets/ingredient.json'), IngredientsResponse::class, 'json');
        if (!empty($ingredient_in_fridge->getIngredients())) {
            foreach ($ingredient_in_fridge->getIngredients() as $ingredient) {
                if (date('Y-m-d', strtotime($ingredient->getUseBy())) >= $current_date) {
                    if (date('Y-m-d', strtotime($ingredient->getBestBefore())) >= $current_date) {
                        $high_quality_ingredient[] = $ingredient->getTitle();
                    } else {
                        $low_quality_ingredient[] = $ingredient->getTitle();
                    }
                }
            }
        }

        $recipes = $serializer->deserialize(file_get_contents($this->get('kernel')->getProjectDir()
                        . '/assets/recipe.json'), RecipesResponse::class, 'json');
        $last_high_quality_index = 0;
        if (!empty($recipes->getRecipes())) {
            foreach ($recipes->getRecipes() as $recipe) {
                $counter = 0;
                $is_contain_low_quality = false;
                foreach ($recipe->getIngredients() as $ingredient) {
                    if (in_array($ingredient, $high_quality_ingredient)) {
                        $counter++;
                    } elseif (in_array($ingredient, $low_quality_ingredient)) {
                        $counter++;
                        $is_contain_low_quality = true;
                    } else {
                        break;
                    }
                }
                if ($counter == count($recipe->getIngredients())) {
                    if ($is_contain_low_quality) {
                        $recommendations[] = $recipe->getTitle();
                    } else {
                        array_splice($recommendations, $last_high_quality_index, 0, $recipe->getTitle());
                        $last_high_quality_index++;
                    }
                }
            }
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setCharset('UTF-8');
        $response->setContent(json_encode([
            'recipes' => $recommendations,
        ]));
        return $response;
    }
}
