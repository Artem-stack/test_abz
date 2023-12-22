<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $positions = [
            ['name' => 'Security'],
            ['name' => 'Designer'],
            ['name' => 'Content manager'],
            ['name' => 'Lawyer'],
            ['name' => 'Backend'],
            ['name' => 'Frontend'],
            ['name' => 'Fullstack'],
        ];

        DB::table('positions')->insert($positions);
    }
}
