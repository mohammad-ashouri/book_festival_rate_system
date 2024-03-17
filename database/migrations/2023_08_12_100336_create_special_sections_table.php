<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('special_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('special_sections')->insert([
            ['name' => 'جهاد تبیین', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'فقه معاصر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ابعاد علمی بیانیه گام دوم انقلاب', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'زن و خانواده', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'الگوی اسلامی ایرانی پیشرفت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'علوم انسانی اسلامی، فضای مجازی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'آسیب های اجتماعی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'جمعیت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اقتصاد مقاومتی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'سبک زندگی اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'هنر (فلسفه هنر، هنر در اسلام)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'محیط زیست و منابع طبیعی', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_sections');
    }
};
