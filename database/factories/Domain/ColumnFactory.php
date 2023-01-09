<?php

namespace Database\Factories\Domain;

use App\Http\Domain\Board;
use App\Http\Domain\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Column>
 */
class ColumnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var Board $board */
        $board = Board::factory()->create();

        return [
            'board_id' => $board->id,
            'title' => fake()->name(),
            'order' => 1,
        ];
    }
}
