<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'sleep_at_home',
        'eat_at_home'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfWeekBeginningAt(Builder $query, CarbonImmutable $firstDayOfWeek): Builder
    {
        return $query->whereBetween('date', [$firstDayOfWeek->toDateString(), $firstDayOfWeek->addDays(6)->toDateString()]);
    }
}
