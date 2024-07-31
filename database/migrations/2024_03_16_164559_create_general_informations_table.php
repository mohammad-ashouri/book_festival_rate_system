<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code', 20)->unique()->nullable();
            $table->string('howzah_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender', 5)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('nationality')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_informations');
    }
};
