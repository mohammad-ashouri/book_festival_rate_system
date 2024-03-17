<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('festivals')->insert([
            ['id'=>25,'name' => 'بیست و پنجم', 'start_date' => '2023/05/20', 'starter' => '1', 'finish_date' => '2023/08/20', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
