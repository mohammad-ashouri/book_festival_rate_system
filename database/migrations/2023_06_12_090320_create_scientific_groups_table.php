<?php

use App\Models\Catalogs\ScientificGroup;
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
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('scientific_groups')->insert([
            ['name' => 'اخلاق و عرفان', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ادبیات و هنر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اقتصاد', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مدیریت', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تاریخ،سیره و تراجم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ترجمه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تصحیح و تحقیق', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تفسیر و علوم قرآن', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'تکنولوژی آموزشی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حدیث، درایه و رجال', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'حقوق', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'علوم سیاسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'علوم اجتماعی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'علوم تربیتی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'روانشناسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'فقه و اصول', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'کلام', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'کتب مرجع', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انقلاب اسلامی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'فلسفه', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('scientific_groups')->insert([
            ['name' => 'نامشخص', 'status' => 0],
        ]);

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scientific_groups');
    }
};
