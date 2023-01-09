<?php

namespace Database\Factories\Domain;

use App\Http\Domain\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function fake;

/**
 * @extends Factory<Board>
 */
class BoardFactory extends Factory
{
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
