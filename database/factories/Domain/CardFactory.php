<?php

namespace Database\Factories\Domain;

use App\Domain\Card;
use App\Domain\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

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
            'description' => fake()->paragraph(),
            'order' => 1,
        ];
    }
}
