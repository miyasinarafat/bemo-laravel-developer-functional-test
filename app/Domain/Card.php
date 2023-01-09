<?php

namespace App\Domain;

use App\Models\User;
use Database\Factories\Domain\CardFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    const POSITION_GAP = 60000;
    const POSITION_MIN = 0.00002;

    protected $fillable = [
        'user_id',
        'board_id',
        'list_id',
        'title',
        'description',
        'position',
    ];

    /**
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->position = self::query()->where('list_id', $model->list_id)->orderByDesc('position')->first()?->position + self::POSITION_GAP;
        });

        static::saved(function ($model) {
            if ($model->position < self::POSITION_MIN) {
                DB::statement("SET @previousPosition := 0");
                DB::statement("
                    UPDATE cards
                    SET position = (@previousPosition := @previousPosition + ?)
                    WHERE list_id = ?
                    ORDER BY position
                ", [
                        self::POSITION_GAP,
                        $model->list_id
                    ]);
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function list(): BelongsTo
    {
        return $this->belongsTo(CardList::class, 'list_id', 'id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return CardFactory::new();
    }
}
