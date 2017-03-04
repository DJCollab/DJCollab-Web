<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('queues', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('party_id')->unsigned();
          $table->string('song_id');
          $table->string('title');
          $table->string('artist');
          $table->string('album');
          $table->string('album_image');
          $table->integer('votes')->default(0);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('queues');
    }
}
