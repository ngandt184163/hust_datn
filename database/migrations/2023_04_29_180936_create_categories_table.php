<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            // $table->string('avatar')->nullable();
            $table->string('slug')->unique()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('status')->default(1);
            // $table->tinyInteger('hot')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
