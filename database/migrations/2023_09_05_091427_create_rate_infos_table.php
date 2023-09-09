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
        Schema::create('rate_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('rate_status')->default('Summary');

            $table->string('ej1g1rater')->nullable()->comment('Ejmali1 Group1 Rater');
            $table->foreign('ej1g1rater')->references('id')->on('users');
            $table->string('ej2g1rater')->nullable()->comment('Ejmali2 Group1 Rater');
            $table->foreign('ej2g1rater')->references('id')->on('users');
            $table->string('ej3g1rater')->nullable()->comment('Ejmali3 Group1 Rater');
            $table->foreign('ej3g1rater')->references('id')->on('users');

            $table->unsignedBigInteger('ej1g2rater')->nullable()->comment('Ejmali1 Group2 Rater');
            $table->foreign('ej1g2rater')->references('id')->on('users');
            $table->unsignedBigInteger('ej2g2rater')->nullable()->comment('Ejmali2 Group2 Rater');
            $table->foreign('ej2g2rater')->references('id')->on('users');
            $table->unsignedBigInteger('ej3g2rater')->nullable()->comment('Ejmali3 Group2 Rater');
            $table->foreign('ej3g2rater')->references('id')->on('users');

            $table->unsignedBigInteger('t1rater')->nullable()->comment('Tafsili1 Rater');
            $table->foreign('t1rater')->references('id')->on('users');
            $table->unsignedBigInteger('t2rater')->nullable()->comment('Tafsili2 Rater');
            $table->foreign('t2rater')->references('id')->on('users');
            $table->unsignedBigInteger('t3rater')->nullable()->comment('Tafsili3 Rater');
            $table->foreign('t3rater')->references('id')->on('users');

            $table->unsignedBigInteger('trater')->nullable()->comment('Last Tafsili Rater');
            $table->foreign('trater')->references('id')->on('users');

            $table->unsignedBigInteger('formal_literary_rater')->nullable()->comment('Formal Literary Rater');
            $table->foreign('formal_literary_rater')->references('id')->on('users');

            $table->float('avg_ejg1')->nullable()->comment('Ejmali Group1 Average');
            $table->float('avg_ejg2')->nullable()->comment('Ejmali Group2 Average');
            $table->float('grade')->nullable()->comment('Rate Last Grade');

            $table->string('chosen_status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_infos');
    }
};
