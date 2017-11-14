<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('top_id');
            $table->unsignedInteger('mid_id');
            $table->integer('order');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->boolean('visible')->default(1);

            $table->foreign('top_id')
                ->references('id')
                ->on('top_menu')
                ->onDelete('cascade');

            $table->foreign('mid_id')
                ->references('id')
                ->on('mid_menu')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bot_menu');
    }
}
