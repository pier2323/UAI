<?php

namespace Database\Factories;

use App\Models\ActaEntrega;
use App\Models\PersonalEntrega;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActaEntrega>
 */
class ActaEntregaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ActaEntrega::class;
    public function definition(): array
    {
        return [
            'suscripcion' => $this->faker->dateTimeBetween('-30 days', '-20 days'),
            'recepcion_uai' => $this->faker->dateTimeBetween('-20 days', '-10 days'),
            'actuacion_fiscal_id' => rand(1,20),
            'personal_entrega_id' => rand(1, 2),
            'personal_recibe_id' => rand(1,2),
            'personal_uai_id' => rand(1, 2)
        ];
    }
}
