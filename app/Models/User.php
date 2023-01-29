<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function presencesOfWeek(CarbonPeriod $daysOfWeek): array
    {
        $presences = [];

        foreach ($daysOfWeek as $day) {
            $date = $day->toDateString();
            $presence = $this->presences()->firstWhere([
                'date' => $date
            ]);

            if (!$presence) {
                $presence = new Presence([
                    'date' => $date,
                    'user_id' => $this->id
                ]);
            }

            $presences[] = $presence;
        }

        return $presences;
    }

    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class);
    }
}
