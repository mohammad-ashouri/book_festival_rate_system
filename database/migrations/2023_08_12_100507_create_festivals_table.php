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
            $table->date('start_date');
            $table->unsignedBigInteger('starter');
            $table->foreign('starter')->references('id')->on('users');
            $table->date('finish_date')->nullable();
            $table->unsignedBigInteger('finisher')->nullable();
            $table->foreign('finisher')->references('id')->on('users');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
