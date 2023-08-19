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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->unsignedBigInteger('festival_id');
            $table->foreign('festival_id')->references('id')->on('festivals');
            $table->text('title');
            $table->string('post_format');
            $table->string('post_type');
            $table->string('language');
            $table->string('pages_number');
            $table->unsignedBigInteger('special_section')->nullable();
            $table->foreign('special_section')->references('id')->on('special_sections');
            $table->string('properties')->nullable();

            //book fields
            $table->string('publisher')->nullable();
            $table->string('ISSN')->nullable();
            $table->string('publish_status')->default('منتشر شده')->nullable();
            $table->integer('number_of_covers')->nullable();
            $table->string('book_size')->nullable();
            $table->integer('circulation')->nullable();

            //thesis fields
            $table->string('thesis_certificate_number')->nullable();
            $table->string('thesis_defence_place')->nullable();
            $table->integer('thesis_grade')->nullable();
            $table->string('thesis_supervisor')->nullable();
            $table->string('thesis_advisor')->nullable();
            $table->string('thesis_referee')->nullable();

            //research type
            $table->string('research_type');
            $table->string('scientific_group_v1');
            $table->foreign('scientific_group_v1')->references('id')->on('scientific_groups');
            $table->string('scientific_group_v2')->nullable();
            $table->foreign('scientific_group_v2')->references('id')->on('scientific_groups');

            //Sorting
            $table->tinyInteger('sorted')->default(0);
            $table->integer('sorter')->nullable();
            $table->string('sorted_date')->nullable();
            $table->integer('sorting_classification_id')->nullable();
            $table->foreign('sorting_classification_id')->references('id')->on('users');

            //cooperation method
            $table->string('activity_type')->default('فردی');
            $table->integer('participation_percentage')->default(100);

            //delivery to festival
            $table->string('post_delivery_method');
            $table->text('file_src')->nullable();
            $table->text('thesis_proceedings_src')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
