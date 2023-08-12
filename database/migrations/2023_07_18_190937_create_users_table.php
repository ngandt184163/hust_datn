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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('email')->unique()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('password')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('address')->nullable()->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('gender')->nullable()->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('phone')->nullable()->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('avatar')->nullable()->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->date('birthday')->nullable();
            $table->integer('total_follow')->default(0);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
