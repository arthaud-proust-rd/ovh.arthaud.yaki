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

    protected $attributes = [
        'sleep_at_home' => false,
        'eat_midday_at_home' => false,
        'eat_evening_at_home' => false
    ];

    protected $fillable = [
        'user_id',
        'date',
        'sleep_at_home',
        'eat_midday_at_home',
        'eat_evening_at_home'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsTotallyPresentAttribute(): bool
    {
        return $this->eat_midday_at_home
            && $this->eat_evening_at_home
            && $this->sleep_at_home;
    }

    public function getIsTotallyAbsentAttribute(): bool
    {
        return !$this->eat_midday_at_home
            && !$this->eat_evening_at_home
            && !$this->sleep_at_home;
    }

    public function scopeOfWeekBeginningAt(Builder $query, CarbonImmutable $firstDayOfWeek): Builder
    {
        return $query->whereBetween('date', [$firstDayOfWeek->toDateString(), $firstDayOfWeek->addDays(6)->toDateString()]);
    }
}
