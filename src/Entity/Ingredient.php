<?php

namespace App\Entity;

/**
 * Description of Ingredient
 *
 * @author reachusolutions
 */
class Ingredient
{
    /** @var string */
    private $title;

    /** @var string */
    private $best_before;

    /** @var string */
    private $use_by;

    public function getTitle()
    {
        return $this->title;
    }

    public function getBestBefore()
    {
        return $this->best_before;
    }

    public function getUseBy()
    {
        return $this->use_by;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBestBefore($best_before)
    {
        $this->best_before = $best_before;
    }

    public function setUseBy($use_by)
    {
        $this->use_by = $use_by;
    }
}
