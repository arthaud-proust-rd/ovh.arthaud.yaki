<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DefaultPresence extends Model
{
    use HasFactory;

    protected $attributes = [
        'sleep_at_home' => false,
        'eat_midday_at_home' => false,
        'eat_evening_at_home' => false
    ];

    protected $fillable = [
        'user_id',
        'day_of_week',
        'sleep_at_home',
        'eat_midday_at_home',
        'eat_evening_at_home'
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
}
