<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionFieldToHairstyles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('haircuts', function (Blueprint $table) {
            $table->string('description')->default('')->after('type');
        });
        \Artisan::call('db:seed', ['--class' => HaircutStylesSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('haircuts', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
