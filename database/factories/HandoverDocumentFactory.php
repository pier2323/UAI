<?php

namespace Database\Factories;

use App\Models\HandoverDocument;
use App\Models\PersonalEntrega;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HandoverDocument>
 */
class HandoverDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = HandoverDocument::class;
    public function definition(): array
    {
        return [
            'subscription' => $this->faker->dateTimeBetween(startDate: '-30 days', endDate: '-20 days'),
            'delivery_uai' => $this->faker->dateTimeBetween(startDate: '-20 days', endDate: '-10 days'),
            'audit_activity_id' => $this->generateNewId(),
            'employee_outgoing_id' => rand(min: 1, max: 10),
            'employee_incoming_id' => rand(min: 1, max: 10),
        ];
    }

    // ! to fix
    private function generateNewId(): int
    {
        do {
            $audit_activity_id = rand(min: 1, max: 20);
            echo "$audit_activity_id\n";
            echo "--------------------\n";
            var_dump(HandoverDocument::where(column: 'audit_activity_id', operator: $audit_activity_id)->exists());
            echo "--------------------\n";
        } 
        while (HandoverDocument::where(column: 'audit_activity_id', operator: $audit_activity_id)->exists());

        echo "end\n";

        return $audit_activity_id;
    }
}
