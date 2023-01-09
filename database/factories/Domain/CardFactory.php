<?php

namespace Database\Factories\Domain;

use App\Domain\Card;
use App\Domain\CardList;
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
        /** @var CardList $column */
        $list = CardList::factory()->create();

        return [
            'user_id' => $list->user_id,
            'board_id' => $list->board_id,
            'list_id' => $list->id,
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'position' => 1,
        ];
    }
}
