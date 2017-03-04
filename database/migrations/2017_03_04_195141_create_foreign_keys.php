<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('queues', function($table) {
        $table->foreign('party_id')->references('id')->on('parties');
      });

      Schema::table('parties', function($table) {
        $table->foreign('host_id')->references('id')->on('users');
        $table->foreign('created_by')->references('id')->on('users');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
