<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeeder extends Seeder
{
    use RefreshDatabase;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create()->each(
            function ($user) {
                Team::create([
                    'user_id' => $user->id,
                    'name' => $user->name. "'s Team",
                    'personal_team' => 1
                ]);
            }
        );

        Company::factory(5)->create();

        for ($i=1; $i<6; $i++) {
            Employee::factory(5)->create([
                'company_id' => $i
            ]);
        }
    }
}
