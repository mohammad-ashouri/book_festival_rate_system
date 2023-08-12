<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scientific_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        $query = ("INSERT INTO `scientific_groups` (`id`, `name`) VALUES
(1, 'اخلاق و عرفان' ),
(2, 'ادبیات و هنر'),
(3, 'اقتصاد'),
(4, 'مدیریت'),
(5, 'تاریخ،سیره و تراجم'),
(6, 'ترجمه'),
(7, 'تصحیح و تحقیق'),
(8, 'تفسیر و علوم قرآن'),
(9, 'تکنولوژی آموزشی'),
(10, 'حدیث، درایه و رجال'),
(11, 'حقوق'),
(12, 'علوم سیاسی'),
(13, 'علوم اجتماعی'),
(14, 'علوم تربیتی'),
(15, 'روانشناسی'),
(16, 'فقه و اصول'),
(17, 'کلام'),
(18, 'کتب مرجع'),
(19, 'انقلاب اسلامی');");
        DB::statement($query);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scientific_groups');
    }
};
