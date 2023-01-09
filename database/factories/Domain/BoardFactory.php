<?php

namespace Database\Factories\Domain;

use App\Domain\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Board>
 */
class BoardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Board::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var User $user */
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'title' => fake()->name(),
        ];
    }
}
