<?php

namespace App\Http\Controllers;

use App\Domain\Board;
use App\Domain\Card;
use App\Domain\CardList;
use Illuminate\Http\RedirectResponse;

class CardListController extends Controller
{
    /**
     * @param Board $board
     * @return RedirectResponse
     */
    public function store(Board $board): RedirectResponse
    {
        request()->validate([
                'title' => ['required']
            ]);

        CardList::create([
            'board_id' => $board->id,
            'user_id' => auth()->id(),
            'title' => request('title'),
        ]);

        return redirect()->back();
    }

    /**
     * @param Board $board
     * @param CardList $list
     * @return RedirectResponse
     */
    public function destroy(Board $board, CardList $list): RedirectResponse
    {
        $list->delete();
        return redirect()->route('boards.show', ['board' => $board->id]);
    }
}
