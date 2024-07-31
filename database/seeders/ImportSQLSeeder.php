<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportSQLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(file_get_contents('database/migrations/users.sql'));
        DB::unprepared(file_get_contents('database/migrations/general_informations.sql'));
//        DB::unprepared(file_get_contents('database/migrations/posts.sql'));
    }
}
