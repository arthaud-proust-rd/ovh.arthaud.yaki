<?php

namespace Database\Seeders;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::cursor() as $user) {
            $date = now();

            for ($i = 0; $i < 1; $i++) {
                Presence::factory()
                    ->for($user)
                    ->create([
                        'date' => $date->copy()
                    ]);

                $date->addDay();
            }
        }
    }
}
