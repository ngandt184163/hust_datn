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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('slug')->unique()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('avatar')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('video')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_video')->default(-1);
            $table->integer('total_like')->default(0);
            $table->integer('total_comment')->default(0);
            $table->integer('menu_id')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->integer('pet_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('articles');
    }
};
