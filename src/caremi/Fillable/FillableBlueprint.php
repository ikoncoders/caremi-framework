<?php declare(strict_types=1);
namespace Caremi\Fillable;

use Caremi\Fillable\Faker\Faker;
use Caremi\Fillable\FillableBlueprintInterface;

class FillableBlueprint implements FillableBlueprintInterface
{

    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;  
    }

    public function faker(): object
    {
        return $this->faker;
    }
}