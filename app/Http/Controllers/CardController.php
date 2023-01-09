<?php

namespace App\Http\Controllers;

use App\Domain\Card;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CardController extends Controller
{
    public function index(): JsonResponse
    {
        $cards = Card::query()
            ->where('user_id', auth()->id())
            ->orderBy('position');

        if (request()->has('date')) {
            $cards = $cards->where('created_at', '>=', request('date'));
        }

        if (request()->has('status')) {
            $cards = $cards->withTrashed();
        }

        $cards = $cards->paginate();

        return response()->json([
            'list' => $cards->items(),
            'paginate' => [
                'page' => $cards->currentPage(),
                'per_page' => $cards->perPage(),
                'last_page' => $cards->lastPage(),
                'total' => $cards->total(),
            ],
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'board_id' => ['required', 'exists:boards,id'],
            'list_id' => ['required', 'exists:card_lists,id'],
            'title' => ['required']
        ]);

        Card::create([
            'board_id' => request('board_id'),
            'list_id' => request('list_id'),
            'title' => request('title'),
            'user_id' => auth()->id()
        ]);

        return redirect()->back();
    }

    /**
     * @param Card $card
     * @return Redirector|RedirectResponse|Application
     */
    public function update(Card $card): Redirector|RedirectResponse|Application
    {
        request()->validate([
            'title' => ['required']
        ]);

        $card->update([
            'title' => request('title'),
            'description' => request()->has('description') ? request('description') : $card->description,
        ]);

        if (request()->has('redirectUrl')) {
            return redirect(request('redirectUrl'));
        }

        return redirect()->back();
    }

    /**
     * @param Card $card
     * @return RedirectResponse
     */
    public function move(Card $card): RedirectResponse
    {
        request()->validate([
            'cardListId' => ['required', 'exists:card_lists,id'],
            'position' => ['required', 'numeric']
        ]);

        $card->update([
            'list_id' => request('cardListId'),
            'position' => round(request('position'), 5)
        ]);

        return redirect()->back();
    }

    /**
     * @param Card $card
     * @return RedirectResponse
     */
    public function destroy(Card $card): RedirectResponse
    {
        $card->delete();
        return redirect()->route('boards.show', ['board' => $card->board_id]);
    }
}
