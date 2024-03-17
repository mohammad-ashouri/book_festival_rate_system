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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('type')->comment('
            1 => SuperAdmin , 2 => Admin , 3 => Header , 4 => Rater , 5 => Classification expert
            ');
            $table->unsignedBigInteger('scientific_group')->nullable();
            $table->foreign('scientific_group')->references('id')->on('scientific_groups');
            $table->string('subject');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('NTCP')->default(0)->comment('Needs To Change Password');
            $table->text('user_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
