<?php

namespace Database\Factories;

use App\Models\Kpi;
use Illuminate\Database\Eloquent\Factories\Factory;

class KpiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kpi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kpi' => $this->faker->name(),
        ];
    }
}
