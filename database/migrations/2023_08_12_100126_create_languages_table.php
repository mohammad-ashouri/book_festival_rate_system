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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('languages')->insert([
            ['name' => 'فارسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'عربی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'انگلیسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'اردو', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'فرانسوی', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
