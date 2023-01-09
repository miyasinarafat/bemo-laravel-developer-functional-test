<?php

namespace Database\Factories\Domain;

use App\Http\Domain\Card;
use App\Http\Domain\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var Column $column */
        $column = Column::factory()->create();

        return [
            'board_id' => $column->board_id,
            'column_id' => $column->id,
            'title' => fake()->name(),
            'description' => fake()->name(),
            'order' => 1,
        ];
    }
}
