<?php

namespace Database\Factories\Domain;

use App\Domain\Board;
use App\Domain\CardList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CardList>
 */
class CardListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CardList::class;

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
            'user_id' => $board->user_id,
            'board_id' => $board->id,
            'title' => fake()->name(),
        ];
    }
}
