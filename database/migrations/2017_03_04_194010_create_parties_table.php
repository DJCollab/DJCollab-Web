<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('parties', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('password')->nullable();
          $table->integer('host_id')->unsigned();
          $table->integer('threshold')->unsigned()->default(5);
          $table->integer('created_by')->unsigned();
          $table->integer('queue')->default(0);
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
        Schema::dropIfExists('parties');

    }
}
