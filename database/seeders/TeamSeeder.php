<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = ['BE developer', 'FE developer', 'tester'];
        foreach ($teams as $team) {
            Team::create(['name' => $team]);
        }
    }
}
