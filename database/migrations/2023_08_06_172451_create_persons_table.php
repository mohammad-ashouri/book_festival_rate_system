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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('family',150);
            $table->string('national_code',10)->unique();
            $table->string('howzah_code')->nullable();
            $table->string('mobile',11);
            $table->string('gender',10);
            $table->timestamps();
            $table->softDeletes();
        });
        $query="INSERT INTO `persons` (`id`, `name`, `family`, `national_code`, `howzah_code`, `mobile`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'علی', 'زمانی', '0356365956', '21154', '09145246352', 'مرد', '2023-09-09 05:16:07', '2023-09-09 05:16:07', NULL);";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
