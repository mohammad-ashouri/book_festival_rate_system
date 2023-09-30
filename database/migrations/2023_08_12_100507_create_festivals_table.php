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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_date',25);
            $table->unsignedBigInteger('starter');
            $table->foreign('starter')->references('id')->on('users');
            $table->string('finish_date',25);
            $table->unsignedBigInteger('finisher');
            $table->foreign('finisher')->references('id')->on('users');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('festivals')->insert([
            ['id'=>25,'name' => 'بیست و پنجم', 'start_date' => '1402/02/10', 'starter' => '1', 'finish_date' => '1402/05/10', 'finisher' => '1', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
