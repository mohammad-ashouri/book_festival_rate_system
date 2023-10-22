<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('summary_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rate_info_id');
            $table->foreign('rate_info_id')->references('id')->on('rate_infos');
            $table->string('post_type');
            $table->string('connection_with_group');
            $table->float('r1');
            $table->float('r2');
            $table->float('r3');
            $table->float('r4')->nullable();
            $table->float('sum');
            $table->string('rate_type');
            $table->unsignedBigInteger('rater');
            $table->foreign('rater')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_rates');
    }
};
