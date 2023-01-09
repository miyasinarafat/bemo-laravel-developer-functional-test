<?php

namespace Database\Seeders;

use App\Domain\Board;
use App\Domain\Card;
use App\Domain\CardList;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Arafat',
            'email' => 'arafat@bemo.com',
            'password' => bcrypt('secret'),
        ]);

        $boards = Board::factory(10)->for($user)->create();

        foreach ($boards as $board) {
            $cardList = CardList::factory()->create([
                'board_id' => $board->id,
                'user_id' => $user->id
            ]);

            Card::factory(50)->create([
                'board_id' => $board->id,
                'user_id' => $user->id,
                'list_id' => $cardList->id
            ]);
        }
    }
}
