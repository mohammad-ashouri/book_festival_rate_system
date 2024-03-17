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
            ['id'=>13,'name' => 'سیزدهم', 'start_date' => '2011/02/20', 'starter' => '1', 'finish_date' => '2011/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>14,'name' => 'چهاردهم', 'start_date' => '2012/02/20', 'starter' => '1', 'finish_date' => '2012/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>15,'name' => 'پانزدهم', 'start_date' => '2013/02/20', 'starter' => '1', 'finish_date' => '2013/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>16,'name' => 'شانزدهم', 'start_date' => '2014/02/20', 'starter' => '1', 'finish_date' => '2014/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>17,'name' => 'هفدهم', 'start_date' => '2015/02/20', 'starter' => '1', 'finish_date' => '2015/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>18,'name' => 'هجدهم', 'start_date' => '2016/02/20', 'starter' => '1', 'finish_date' => '2016/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>19,'name' => 'نوزدهم', 'start_date' => '2017/02/20', 'starter' => '1', 'finish_date' => '2017/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>20,'name' => 'بیستم', 'start_date' => '2018/02/20', 'starter' => '1', 'finish_date' => '2018/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>21,'name' => 'بیست و یکم', 'start_date' => '2019/02/20', 'starter' => '1', 'finish_date' => '2019/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>22,'name' => 'بیست و دوم', 'start_date' => '2020/02/20', 'starter' => '1', 'finish_date' => '2020/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>23,'name' => 'بیست و سوم', 'start_date' => '2021/02/20', 'starter' => '1', 'finish_date' => '2021/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>24,'name' => 'بیست و چهارم', 'start_date' => '2022/02/20', 'starter' => '1', 'finish_date' => '2022/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>25,'name' => 'بیست و پنجم', 'start_date' => '2023/02/20', 'starter' => '1', 'finish_date' => '2023/05/22', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id'=>26,'name' => 'بیست و ششم', 'start_date' => '2024/02/20', 'starter' => '1', 'finish_date' => '2024/05/21', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
