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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->unique()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });

        Schema::create('users_has_types', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('user_type_id')->default(0);
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
        Schema::dropIfExists('user_types');
        Schema::dropIfExists('users_has_types');
    }
};
