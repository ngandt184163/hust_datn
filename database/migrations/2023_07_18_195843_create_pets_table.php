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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('avatar')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('slug')->unique()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->char('sex', 20)->nullable()->default('duc')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->integer('age')->default(0);
            $table->unsignedBigInteger('category_id')->default(0)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->integer('total_like')->default(0);
            $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
