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
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('publishers')->insert([
            ['name' => 'جامعه المصطفي العالميه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دليل ما', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مجمع ذخائر اسلامي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'نسيم حيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'صحيفه خرد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'بنياد پژوهشهاي اسلامي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشگاه فرهنگ و انديشه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پارسایان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'المصطفی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'محمدجواد مروجی طبسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مرکز بین المللی ترجمه و نشر المصطفی (ص)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مرکز تنظیم و نشر آثار حضرت آیت الله العظمی صافی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه تنظیم و نشر آثار امام خمینی (ره)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عروج اندیشه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'نورالسجاد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'هاجر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'جامعة الزهراء', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دائره المعارف فقه اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دارالعلم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دفتر مطالعات و تحقیقات زنان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دفتر نشر معارف', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پاد انديشه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مركز بين المللي ترجمه و نشر المصطفي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'نشر خويي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'موسسه الرافد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مولف', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'محمدامين نجف', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'بنياد پژوهش هاي اسلامي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مؤسسه البلاغ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'al-rasoolpublications (india)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'زهد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ايرا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حيات طيبه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'كتاب آشنا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عروج', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اميرالعلم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'محقق اردبيلي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'نورالزهرا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دفتر نشر معروف', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'منير', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'زائر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تماشا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'چلچراغ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مدرسه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دارالعلم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'صفحه‌نگار', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اكرام', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اسراء', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ميزان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مؤسسه اطلاع رساني اسلامي مرجع', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عقيق عشق', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عمو علوي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'وفا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ارغوان دانش', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'نجفي', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اسوه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'بکا', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'بین الملل', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'بین المللی الهدی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پرتو ولایت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پرهیزکار', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشگاه حوزه و دانشگاه، موسسه دائره المعارف فقه اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پژوهشکده باقرالعلوم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام آزادگان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام آزادی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام جلال', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام مقدس', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام مهر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیام کلیدر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'پیشتاز', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تامین', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تمهید', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تکا (وابسته به نمایشگاه های فرهنگی ایران)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'آیات بینات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'آیت اشراق', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'آیه حیات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ابتکار دانش', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ادباء', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اشک یاس', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اشکذر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'الامیره', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'الهادی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ام ابیها', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'امام حسین (ع)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'امیرالمومنین (ع)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'امیرکبیر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'امین الله', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انتشارات مؤلفان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انتظار سبز', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انجمن آثار و مفاخر فرهنگی و دانشگاه تهران', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انصاری', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انصاریان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'گلهای بهشت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مؤسسه نشر اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مبارک', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مبین اندیشه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مجمع احیای فرهنگ اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مجمع جهانی اهل بیت(ع)', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
