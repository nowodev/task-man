<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = ['Hospital', 'School', 'Police Station', 'Prison'];

        foreach ($projects as $project) {
            DB::table('projects')->insert(['name' => $project]);
        }
    }
}
