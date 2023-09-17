<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contractor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ybazli\Faker\Facades\Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
//            ContractorSeeder::class,
        ]);

        DB::table('languages')->insert([
            ['name' => 'فارسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عربی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انگلیسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اردو', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'فرانسوی', 'created_at' => now(), 'updated_at' => now()],
        ]);

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

        DB::table('festivals')->insert([
            ['id'=>25,'name' => 'بیست و پنجم', 'start_date' => '1402/02/10', 'starter' => '1', 'finish_date' => '1402/05/10', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()]
        ]);

    }
}
