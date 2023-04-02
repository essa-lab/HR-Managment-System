<?php

namespace Database\Seeders;

use App\Model\employessStatus;
use App\Models\employees;
use App\Models\jobs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        employees::factory()->count(1000)->create();
        jobs::factory()->count(500)->create();
        \App\Models\employessStatus::factory()->count(1000)->create();
    }
}
