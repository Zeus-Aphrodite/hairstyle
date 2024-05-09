<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaircutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haircuts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->enum('type', ['short', 'medium', 'long']);
            $table->string('wig_cloudinary_id')->default('');
            $table->string('preview_cloudinary_id')->default('');
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
        Schema::drop('haircuts');
    }
}
