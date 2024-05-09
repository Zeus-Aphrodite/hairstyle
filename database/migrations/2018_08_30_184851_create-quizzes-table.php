<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->string('text');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('quiz_question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_question_id')->unsigned();
            $table->string('text');
            $table->timestamps();

            $table->foreign('quiz_question_id')
                ->references('id')
                ->on('quiz_questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        \Artisan::call('db:seed', ['--class' => QuizSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_question_options');
        Schema::drop('quiz_questions');
        Schema::drop('quizzes');
    }
}
