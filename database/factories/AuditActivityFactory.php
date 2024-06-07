<?php

namespace Database\Factories;

use App\Models\AuditActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditActivity>
 */
class AuditActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     * Define el estado predeterminado del modelo 
     * @return array<string, mixed>
    */

    protected $model = AuditActivity::class;
    
    public function definition(): array
    {
        return [
            'objective' => $this->faker->sentence(),
            'type_audit_id' => 1
        ];
    }


}