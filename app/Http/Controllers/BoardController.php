<?php

namespace App\Http\Controllers;

use App\Domain\Board;
use App\Domain\Card;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BoardController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Boards/Index', [
            'boards' => auth()->user()->boards
        ]);
    }

    /**
     * @param Board $board
     * @param Card|null $card
     * @return Response
     */
    public function show(Board $board, Card $card = null): Response
    {
        $board->load([
            'lists.cards' => fn($query) => $query->orderBy('position')
        ]);

        return Inertia::render('Boards/Show', [
            'board' => $board,
            'card' => $card,
        ]);
    }

    /**
     * @param Board $board
     * @return RedirectResponse
     */
    public function update(Board $board): RedirectResponse
    {
        request()->validate([
            'title' => ['required', 'max:255']
        ]);

        $board->update(['title' => request('title')]);

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'title' => ['required']
        ]);

        Board::create([
            'user_id' => auth()->id(),
            'title' => request('title')
        ]);

        return redirect()->back();
    }
}
