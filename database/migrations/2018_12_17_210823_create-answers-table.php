<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packed_haircut_selections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('haircut_id')->unique();
            $table->unsignedInteger('count')->default(0);
            $table->timestamps();

            $table->foreign('haircut_id')->references('id')->on('haircuts')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packed_haircut_selections');
    }
}
