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
            $table->string('sg1_form_type')->default('Waiting For Header');
            $table->string('sg2_form_type')->default('Waiting For Header')->nullable();
            $table->string('d1_form_type')->default('Waiting For Admin')->nullable();

            $table->unsignedBigInteger('s1g1rater')->nullable()->comment('Ejmali1 Group1 Rater');
            $table->foreign('s1g1rater')->references('id')->on('users');
            $table->string('s1g1_rater_set_date')->nullable()->comment('Ejmali1 Group1 Rater Set Date');
            $table->boolean('s1g1_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('s2g1rater')->nullable()->comment('Ejmali2 Group1 Rater');
            $table->foreign('s2g1rater')->references('id')->on('users');
            $table->string('s2g1_rater_set_date')->nullable()->comment('Ejmali2 Group1 Rater Set Date');
            $table->boolean('s2g1_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('s3g1rater')->nullable()->comment('Ejmali3 Group1 Rater');
            $table->foreign('s3g1rater')->references('id')->on('users');
            $table->string('s3g1_rater_set_date')->nullable()->comment('Ejmali3 Group1 Rater Set Date');
            $table->boolean('s3g1_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('s1g2rater')->nullable()->comment('Ejmali1 Group2 Rater');
            $table->foreign('s1g2rater')->references('id')->on('users');
            $table->string('s1g2_rater_set_date')->nullable()->comment('Ejmali1 Group2 Rater Set Date');
            $table->boolean('s1g2_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('s2g2rater')->nullable()->comment('Ejmali2 Group2 Rater');
            $table->foreign('s2g2rater')->references('id')->on('users');
            $table->string('s2g2_rater_set_date')->nullable()->comment('Ejmali2 Group2 Rater Set Date');
            $table->boolean('s2g2_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('s3g2rater')->nullable()->comment('Ejmali3 Group2 Rater');
            $table->foreign('s3g2rater')->references('id')->on('users');
            $table->string('s3g2_rater_set_date')->nullable()->comment('Ejmali3 Group2 Rater Set Date');
            $table->boolean('s3g2_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('d1rater')->nullable()->comment('Tafsili1 Rater');
            $table->foreign('d1rater')->references('id')->on('users');
            $table->string('d1_rater_set_date')->nullable()->comment('Tafsili1 Rater Set Date');
            $table->boolean('d1_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('d2rater')->nullable()->comment('Tafsili2 Rater');
            $table->foreign('d2rater')->references('id')->on('users');
            $table->string('d2_rater_set_date')->nullable()->comment('Tafsili2 Rater Set Date');
            $table->boolean('d2_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('formal_literary_rater')->nullable()->comment('Formal Literary Rater');
            $table->foreign('formal_literary_rater')->references('id')->on('users');
            $table->string('formal_literary_rater_set_date')->nullable()->comment('Formal Literary Rater Set Date');
            $table->boolean('formal_literary_rate_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->unsignedBigInteger('d3rater')->nullable()->comment('Tafsili3 Rater');
            $table->foreign('d3rater')->references('id')->on('users');
            $table->string('d3_rater_set_date')->nullable()->comment('Tafsili3 Rater Set Date');
            $table->boolean('d3_status')->default(0)->comment('0 => not submitted - 1 => submitted');

            $table->float('avg_sg1')->nullable()->comment('Ejmali Group1 Average');
            $table->float('avg_sg2')->nullable()->comment('Ejmali Group2 Average');
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
