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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id_nguon')->default(0)->index()->comment('user di tuong tac');
            $table->integer('user_id_dich')->default(0)->index()->comment('user duoc tuong tac');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0); // status = 0 là thông báo chưa được đọc.
            $table->integer('article_id')->default(0);
            $table->integer('pet_id')->default(0);
            $table->timestamps();
            // type: 1.like article, 2.comment article, 3.follow user, 4.like pet.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
