<?php

namespace Database\Factories\Domain;

use App\Domain\Board;
use App\Domain\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Column>
 */
class ColumnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Column::class;

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
