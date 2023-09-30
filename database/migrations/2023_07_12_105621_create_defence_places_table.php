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
        Schema::create('defence_places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('defence_places')->insert([
            ['name' => 'حوزه علمیه قم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حوزه علمیه خراسان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حوزه علمیه اصفهان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'جامعه المصطفی العالمیه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حوزه علمیه خواهران (همه شهرها)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'جامعه الزهراء(س)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه آموزشی پژوهشی امام خمینی(ره)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه آموزش عالي حوزوي امام رضا(ع)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه آموزش عالي حوزوي معصومیه خواهران', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مؤسسه آموزش عالی بنت‌الهدی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه آموزش عالي حوزوي فدك', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشگاه حوزه و دانشگاه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشگاه علوم انسانی و مطالعات فرهنگی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشكده امام خمینی و انقلاب اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه باقر العلوم(ع)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه قرآن و حدیث', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه علوم اسلامی رضوی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه قم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه مفید', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه ادیان ومذاهب', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه معارف (همه شهرها)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه امام صادق(ع)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه علامه طباطبايي(ره)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه فردوسی مشهد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه تهران', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه تهران (پرديس فارابی قم)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه تربیت مدرس (همه شهرها)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه علوم و معارف قرآن کریم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه اصفهان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشکده اصول دین', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه آزاد اسلامی (همه شهرها)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه پیام نور', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'سایر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه شهید بهشتی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشکده امام خمینی تهران', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه عدالت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه بوعلی سینا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه شهید مطهری', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه شیراز', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه آیت الله حائری-میبد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه مازندران', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه کاشان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه خوارزمی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه بین المللی امام خمینی(ره)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه سمنان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه رازی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشگاه مذاهب اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه آموزش عالی علوم شناختی', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defence_places');
    }
};
